<?php

namespace App\Http\Controllers\Api\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TripResource;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\Trip;
<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function students(Request $request)
    {
        $guardian = $this->guardianOrFail($request);

<<<<<<< HEAD
        $students = $guardian->students()
            ->with(['school', 'trips' => function ($q) {
                $q->active()->with(['vehicle.driver', 'route'])->latest()->limit(1);
            }])
            ->get()
            ->map(function (Student $student) {
                $activeTrip = $student->trips->first();
=======
        $students = $guardian->students()->with('school')->get();

        $activeTrips = Trip::query()
            ->active()
            ->whereIn('student_id', $students->pluck('id'))
            ->with(['vehicle.driver', 'route'])
            ->orderByDesc('id')
            ->get()
            ->unique('student_id')
            ->keyBy('student_id');

        $students = $students->map(function (Student $student) use ($activeTrips) {
                $activeTrip = $activeTrips->get($student->id);
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d

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
<<<<<<< HEAD
        $location = $trip->locations()->latest('recorded_at')->first();
=======
        // reorder() clears any inherited order so we truly get the newest GPS point.
        $location = $trip->locations()
            ->reorder()
            ->latest('recorded_at')
            ->latest('id')
            ->first();
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
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
<<<<<<< HEAD
            ->orderBy('recorded_at')
=======
            ->reorder()
            ->orderBy('recorded_at')
            ->orderBy('id')
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
            ->get(['id', 'latitude', 'longitude', 'accuracy', 'heading', 'speed', 'recorded_at']);

        return response()->json(['data' => $locations]);
    }

<<<<<<< HEAD
    /**
     * Register a new student under guardian with max 6 children and required school location.
     */
    public function storeStudent(Request $request)
    {
        $guardian = $this->guardianOrFail($request);

        // 1. Strict Guardian Child Limit Constraint (Max 6 children)
        if ($guardian->students()->count() >= 6) {
            return response()->json([
                'message' => 'Child registration limit reached. A guardian profile can register a maximum of 6 children.',
                'errors' => [
                    'student_limit' => ['A guardian profile can register a maximum of 6 children.']
                ]
            ], 422);
        }

        // 2. Validate input with mandatory school location and verified GPS coordinates
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'class' => 'required|string|max:50',
            'roll_number' => 'nullable|string|max:50',
            'school_id' => 'required|integer|exists:schools,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'driver_id' => 'nullable|integer|exists:users,id',
        ]);

        // 3. Dynamic Vehicle Capacity Validation (if a driver is selected)
        if (!empty($validated['driver_id'])) {
            $driver = User::role('driver')->with('vehicles')->find($validated['driver_id']);
            $vehicle = $driver?->vehicles->first();
            if ($vehicle) {
                $currentOccupancy = Student::where('driver_id', $driver->id)->count();
                $maxCapacity = $vehicle->capacity; // Car is strictly capped at max 5
                if ($currentOccupancy >= $maxCapacity) {
                    $typeLabel = ucfirst($vehicle->type ?? 'Vehicle');
                    return response()->json([
                        'message' => "Capacity limit reached! This {$typeLabel} cannot exceed {$maxCapacity} passengers ({$currentOccupancy}/{$maxCapacity} occupied).",
                        'errors' => [
                            'driver_id' => ["Vehicle seat capacity exceeded."]
                        ]
                    ], 422);
                }
            }
        }

        $rollNumber = !empty($validated['roll_number']) 
            ? $validated['roll_number'] 
            : ('RN-' . strtoupper(\Illuminate\Support\Str::random(6)));

        $student = Student::create([
            'name' => $validated['name'],
            'class' => $validated['class'],
            'roll_number' => $rollNumber,
            'parent_id' => $guardian->id,
            'school_id' => $validated['school_id'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'driver_id' => $validated['driver_id'] ?? null,
        ]);

        $student->load('school');

        return response()->json([
            'message' => 'Child student successfully registered.',
            'data' => [
                'id' => $student->id,
                'name' => $student->name,
                'class' => $student->class,
                'roll_number' => $student->roll_number,
                'latitude' => (float) $student->latitude,
                'longitude' => (float) $student->longitude,
                'school' => $student->school ? [
                    'id' => $student->school->id,
                    'name' => $student->school->name,
                    'address' => $student->school->address,
                ] : null,
                'active_trip' => null,
            ]
        ], 201);
    }

    /**
     * Assign driver/vehicle to a student with dynamic vehicle capacity limits.
     */
    public function assignDriver(Request $request)
    {
        $guardian = $this->guardianOrFail($request);

        $validated = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'driver_id' => 'required|integer|exists:users,id',
        ]);

        $student = Student::findOrFail($validated['student_id']);
        $this->authorizeStudent($guardian, $student);

        $driver = User::role('driver')->with('vehicles')->findOrFail($validated['driver_id']);
        $vehicle = $driver->vehicles->first();

        // Enforce dynamic vehicle capacity limit (Car max 5, etc.)
        if ($vehicle) {
            $currentOccupancy = Student::where('driver_id', $driver->id)->count();
            $maxCapacity = $vehicle->capacity;
            if ($currentOccupancy >= $maxCapacity) {
                $typeLabel = ucfirst($vehicle->type ?? 'Vehicle');
                return response()->json([
                    'message' => "Capacity limit reached! This {$typeLabel} cannot exceed {$maxCapacity} passengers ({$currentOccupancy}/{$maxCapacity} occupied).",
                    'errors' => [
                        'driver_id' => ["Vehicle seat capacity exceeded."]
                    ]
                ], 422);
            }
        }

        $student->driver_id = $driver->id;
        $student->save();

        return response()->json([
            'success' => true,
            'message' => "Driver {$driver->name} successfully assigned to {$student->name}.",
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'driver_id' => $driver->id,
                'driver_name' => $driver->name,
                'vehicle_plate' => $vehicle?->number_plate ?? 'N/A',
            ]
        ]);
    }

=======
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
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
