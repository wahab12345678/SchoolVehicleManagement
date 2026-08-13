<?php

namespace App\Http\Controllers\Api\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TripResource;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function students(Request $request)
    {
        $guardian = $this->guardianOrFail($request);

        $students = $guardian->students()
            ->with(['school', 'trips' => function ($q) {
                $q->active()->with(['vehicle.driver', 'route'])->latest()->limit(1);
            }])
            ->get()
            ->map(function (Student $student) {
                $activeTrip = $student->trips->first();

                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'roll_number' => $student->roll_number,
                    'class' => $student->class,
                    'latitude' => $student->latitude,
                    'longitude' => $student->longitude,
                    'school' => $student->school ? [
                        'id' => $student->school->id,
                        'name' => $student->school->name,
                        'start_time' => $student->school->start_time,
                        'end_time' => $student->school->end_time,
                        'pickup_lead_minutes' => $student->school->pickup_lead_minutes,
                    ] : null,
                    'active_trip' => $activeTrip ? new TripResource($activeTrip) : null,
                ];
            });

        return response()->json(['data' => $students]);
    }

    public function activeTrip(Request $request, Student $student)
    {
        $guardian = $this->guardianOrFail($request);
        $this->authorizeStudent($guardian, $student);

        $trip = $student->trips()
            ->active()
            ->with(['student', 'vehicle', 'route', 'driver', 'locations' => function ($q) {
                $q->latest('recorded_at')->limit(1);
            }])
            ->latest()
            ->first();

        if (!$trip) {
            return response()->json(['message' => 'No active trip.', 'data' => null]);
        }

        return response()->json(['data' => new TripResource($trip)]);
    }

    public function show(Request $request, Trip $trip)
    {
        $guardian = $this->guardianOrFail($request);
        $this->authorizeTrip($guardian, $trip);

        $trip->load(['student', 'vehicle', 'route', 'driver', 'locations' => function ($q) {
            $q->latest('recorded_at')->limit(1);
        }]);

        return response()->json(['data' => new TripResource($trip)]);
    }

    public function realtime(Request $request, Trip $trip)
    {
        $guardian = $this->guardianOrFail($request);
        $this->authorizeTrip($guardian, $trip);

        $trip->loadMissing(['student.school', 'school']);
        $location = $trip->locations()->latest('recorded_at')->first();
        $school = $trip->school ?? $trip->student?->school;

        return response()->json([
            'trip_id' => $trip->id,
            'status' => $trip->status,
            'direction' => $trip->direction,
            'student' => [
                'id' => $trip->student_id,
                'name' => $trip->student?->name,
                'home' => [
                    'latitude' => $trip->student?->latitude,
                    'longitude' => $trip->student?->longitude,
                ],
            ],
            'school' => $school ? [
                'id' => $school->id,
                'name' => $school->name,
                'latitude' => $school->latitude,
                'longitude' => $school->longitude,
            ] : null,
            'current_location' => $location ? [
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'accuracy' => $location->accuracy,
                'heading' => $location->heading,
                'speed' => $location->speed,
                'recorded_at' => optional($location->recorded_at)?->toIso8601String(),
            ] : null,
            'timestamps' => [
                'pickup_started_at' => optional($trip->pickup_started_at)?->toIso8601String(),
                'arrived_at' => optional($trip->arrived_at)?->toIso8601String(),
                'boarded_at' => optional($trip->boarded_at)?->toIso8601String(),
                'started_at' => optional($trip->started_at)?->toIso8601String(),
                'ended_at' => optional($trip->ended_at)?->toIso8601String(),
            ],
        ]);
    }

    public function locations(Request $request, Trip $trip)
    {
        $guardian = $this->guardianOrFail($request);
        $this->authorizeTrip($guardian, $trip);

        $locations = $trip->locations()
            ->orderBy('recorded_at')
            ->get(['id', 'latitude', 'longitude', 'accuracy', 'heading', 'speed', 'recorded_at']);

        return response()->json(['data' => $locations]);
    }

    private function guardianOrFail(Request $request): Guardian
    {
        $guardian = Guardian::where('user_id', $request->user()->id)->first();
        abort_unless($guardian, 404, 'Guardian profile not found.');

        return $guardian;
    }

    private function authorizeStudent(Guardian $guardian, Student $student): void
    {
        abort_unless($student->parent_id === $guardian->id, 403, 'Student not linked to this guardian.');
    }

    private function authorizeTrip(Guardian $guardian, Trip $trip): void
    {
        $trip->loadMissing('student');
        abort_unless($trip->student && $trip->student->parent_id === $guardian->id, 403, 'Trip not accessible.');
    }
}
