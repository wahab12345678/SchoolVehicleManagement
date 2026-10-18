<?php

namespace App\Services;

use App\Models\Route;
use App\Models\Student;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Validation\ValidationException;

class TripAssignmentService
{
    /**
     * Check that a trip's student, vehicle, route, and driver belong together.
     *
     * @param  array<string, mixed>  $input
     * @return array<string, mixed>
     */
    public function prepare(array $input, ?Trip $existing = null): array
    {
        $student = Student::findOrFail($input['student_id']);
        $vehicle = Vehicle::findOrFail($input['vehicle_id']);
        $route = Route::findOrFail($input['route_id']);
        $status = $input['status'];

        if (!$existing && $status !== 'pending') {
            throw ValidationException::withMessages([
                'status' => 'A new trip must start as pending.',
            ]);
        }

        if ($existing && !$existing->canTransitionTo($status)) {
            $next = Trip::STATUS_FLOW[$existing->status] ?? null;

            throw ValidationException::withMessages([
                'status' => $next
                    ? "Status can only stay {$existing->status} or move to {$next}."
                    : 'This trip is completed and its status cannot change.',
            ]);
        }

        if (!$vehicle->driver_id) {
            throw ValidationException::withMessages([
                'vehicle_id' => 'This vehicle has no driver assigned.',
            ]);
        }

        $driver = User::find($vehicle->driver_id);
        if (!$driver || !$driver->hasRole('driver')) {
            throw ValidationException::withMessages([
                'vehicle_id' => 'The vehicle driver must have the driver role.',
            ]);
        }

        if ((int) $input['driver_id'] !== (int) $vehicle->driver_id) {
            throw ValidationException::withMessages([
                'driver_id' => 'The driver must be the driver assigned to the selected vehicle.',
            ]);
        }

        $this->assertSameSchool($student, $vehicle, $route);

        if (in_array($status, Trip::ACTIVE_STATUSES, true) && $this->studentHasAnotherActiveTrip($student->id, $existing)) {
            throw ValidationException::withMessages([
                'student_id' => 'This student already has an active trip.',
            ]);
        }

        return array_merge([
            'student_id' => $student->id,
            'vehicle_id' => $vehicle->id,
            'route_id' => $route->id,
            'driver_id' => $vehicle->driver_id,
            'school_id' => $student->school_id,
            'status' => $status,
            'direction' => $input['direction'] ?? $existing?->direction ?? 'to_school',
        ], $this->timestampsFor($status, $existing));
    }

    private function assertSameSchool(Student $student, Vehicle $vehicle, Route $route): void
    {
        if ($student->school_id && $vehicle->school_id && (int) $student->school_id !== (int) $vehicle->school_id) {
            throw ValidationException::withMessages([
                'vehicle_id' => 'The vehicle belongs to a different school than the student.',
            ]);
        }

        if ($student->school_id && $route->school_id && (int) $student->school_id !== (int) $route->school_id) {
            throw ValidationException::withMessages([
                'route_id' => 'The route belongs to a different school than the student.',
            ]);
        }
    }

    private function studentHasAnotherActiveTrip(int $studentId, ?Trip $existing): bool
    {
        return Trip::query()
            ->where('student_id', $studentId)
            ->whereIn('status', Trip::ACTIVE_STATUSES)
            ->when($existing, fn ($query) => $query->where('id', '!=', $existing->id))
            ->exists();
    }

    /**
     * @return array<string, \Illuminate\Support\Carbon>
     */
    private function timestampsFor(string $status, ?Trip $existing): array
    {
        $now = now();
        $stamps = [];

        if (in_array($status, ['en_route', 'arrived', 'in_progress', 'completed'], true)) {
            $stamps['pickup_started_at'] = $existing?->pickup_started_at ?? $now;
        }

        if (in_array($status, ['arrived', 'in_progress', 'completed'], true)) {
            $stamps['arrived_at'] = $existing?->arrived_at ?? $now;
        }

        if (in_array($status, ['in_progress', 'completed'], true)) {
            $stamps['boarded_at'] = $existing?->boarded_at ?? $now;
            $stamps['started_at'] = $existing?->started_at ?? $now;
        }

        if ($status === 'completed') {
            $stamps['ended_at'] = $existing?->ended_at ?? $now;
        }

        return $stamps;
    }
}
