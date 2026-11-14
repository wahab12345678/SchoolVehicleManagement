<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * List all vehicles with dynamic capacity & seat metrics.
     */
    public function vehicles(Request $request): JsonResponse
    {
        $query = Vehicle::with(['driver', 'school']);

        if ($request->filled('type') && strtolower($request->type) !== 'all') {
            $query->where('type', strtolower($request->type));
        }

        if ($request->filled('query')) {
            $search = strtolower($request->query('query'));
            $query->where(function ($q) use ($search) {
                $q->where('number_plate', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('id', $search);
            });
        }

        $vehicles = $query->get()->map(function (Vehicle $vehicle) {
            $assignedCount = $vehicle->driver_id 
                ? Student::where('driver_id', $vehicle->driver_id)->count() 
                : 0;

            $effectiveCap = $vehicle->capacity; // Car is strictly max 5 via Vehicle accessor
            $availableSeats = max(0, $effectiveCap - $assignedCount);

            return [
                'id' => $vehicle->id,
                'number_plate' => $vehicle->number_plate,
                'model' => $vehicle->model ?? 'Standard',
                'type' => strtolower($vehicle->type ?? 'van'),
                'capacity' => $effectiveCap,
                'effective_capacity' => $effectiveCap,
                'assigned_students_count' => $assignedCount,
                'students_count' => $assignedCount,
                'available_seats' => $availableSeats,
                'is_available' => $availableSeats > 0,
                'status' => $vehicle->status ?? 'active',
                'notes' => $vehicle->notes,
                'driver' => $vehicle->driver ? [
                    'id' => $vehicle->driver->id,
                    'name' => $vehicle->driver->name,
                    'phone' => $vehicle->driver->phone,
                ] : null,
                'school' => $vehicle->school ? [
                    'id' => $vehicle->school->id,
                    'name' => $vehicle->school->name,
                ] : null,
            ];
        });

        return response()->json([
            'success' => true,
            'count' => $vehicles->count(),
            'data' => $vehicles,
        ]);
    }

    /**
     * List all drivers with assigned vehicle & dynamic capacity metrics.
     */
    public function drivers(Request $request): JsonResponse
    {
        $query = User::role('driver')->with(['vehicles', 'serviceAreas']);

        if ($request->filled('query')) {
            $search = strtolower($request->query('query'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $drivers = $query->get()->map(function ($driver) {
            $primaryVehicle = $driver->vehicles->first();
            $assignedCount = Student::where('driver_id', $driver->id)->count();

            $vehicleData = null;
            if ($primaryVehicle) {
                $effectiveCap = $primaryVehicle->capacity;
                $availableSeats = max(0, $effectiveCap - $assignedCount);
                $vehicleData = [
                    'id' => $primaryVehicle->id,
                    'number_plate' => $primaryVehicle->number_plate,
                    'model' => $primaryVehicle->model ?? 'Standard',
                    'type' => strtolower($primaryVehicle->type ?? 'van'),
                    'capacity' => $effectiveCap,
                    'assigned_students_count' => $assignedCount,
                    'available_seats' => $availableSeats,
                    'is_available' => $availableSeats > 0,
                ];
            }

            return [
                'id' => $driver->id,
                'name' => $driver->name,
                'phone' => $driver->phone,
                'email' => $driver->email,
                'vehicle' => $vehicleData,
                'primary_vehicle' => $vehicleData,
                'assigned_students_count' => $assignedCount,
                'students_count' => $assignedCount,
                'service_areas' => $driver->serviceAreas->pluck('area_name')->values()->all(),
                'is_available' => $vehicleData ? ($vehicleData['available_seats'] > 0) : true,
            ];
        });

        if ($request->filled('vehicle_type') && strtolower($request->vehicle_type) !== 'all') {
            $filterType = strtolower($request->vehicle_type);
            $drivers = $drivers->filter(function ($d) use ($filterType) {
                return isset($d['vehicle']['type']) && $d['vehicle']['type'] === $filterType;
            })->values();
        }

        return response()->json([
            'success' => true,
            'count' => $drivers->count(),
            'data' => $drivers,
        ]);
    }

    /**
     * List all schools with GPS coordinates.
     */
    public function schools(): JsonResponse
    {
        $schools = School::where('is_active', true)
            ->get(['id', 'name', 'address', 'latitude', 'longitude'])
            ->map(function (School $school) {
                return [
                    'id' => $school->id,
                    'name' => $school->name,
                    'address' => $school->address,
                    'latitude' => (float) $school->latitude,
                    'longitude' => (float) $school->longitude,
                ];
            });

        return response()->json([
            'success' => true,
            'count' => $schools->count(),
            'data' => $schools,
        ]);
    }
}
