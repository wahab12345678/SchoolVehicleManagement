<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Get the authenticated driver's profile details including assigned vehicle.
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();
        return response()->json([
            'success' => true,
            'data' => $this->formatDriverProfile($user),
        ]);
    }

    /**
     * Update the authenticated driver's profile details.
     */
    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'cnic' => 'nullable|string|max:30',
            'license_number' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        $user->name = $data['name'];
        if (array_key_exists('phone', $data)) {
            $user->phone = $data['phone'];
        }
        if (array_key_exists('cnic', $data)) {
            $user->cnic = $data['cnic'];
        }
        if (array_key_exists('license_number', $data)) {
            $user->license_number = $data['license_number'];
        }
        if (array_key_exists('address', $data)) {
            $user->address = $data['address'];
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Driver profile updated successfully',
            'data' => $this->formatDriverProfile($user),
        ]);
    }

    /**
     * Helper to format driver profile and primary vehicle info.
     */
    public function formatDriverProfile($user): array
    {
        $primaryVehicle = $user->vehicles()->first() ?? $user->primaryVehicle;
        $vehicleData = null;

        if ($primaryVehicle) {
            $assignedCount = Student::where('driver_id', $user->id)->count();
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
                'status' => $primaryVehicle->status ?? 'active',
            ];
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'cnic' => $user->cnic,
            'license_number' => $user->license_number,
            'address' => $user->address,
            'roles' => $user->getRoleNames(),
            'vehicle' => $vehicleData,
            'primary_vehicle' => $vehicleData,
        ];
    }
}
