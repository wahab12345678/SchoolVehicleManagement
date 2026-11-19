<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'device_name' => 'nullable|string|max:100',
            'role' => 'nullable|in:driver,guardian,parent,admin',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if (!empty($data['role'])) {
            $role = $data['role'] === 'parent' ? 'parent' : $data['role'];
            $allowed = $role === 'guardian'
                ? $user->hasAnyRole(['guardian', 'parent'])
                : $user->hasRole($role);

            if (!$allowed) {
                return response()->json([
                    'message' => 'User does not have the required role.',
                ], 403);
            }
        }

        $tokenName = $data['device_name'] ?? 'mobile-app';
        $token = $user->createToken($tokenName)->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $this->formatUserData($user),
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json($this->formatUserData($user));
    }

    protected function formatUserData(User $user): array
    {
        $primaryVehicle = $user->vehicles()->first() ?? $user->primaryVehicle;
        $vehicleData = null;

        if ($primaryVehicle) {
            $assignedCount = \App\Models\Student::where('driver_id', $user->id)->count();
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
            'guardian' => $user->guardian ? [
                'id' => $user->guardian->id,
                'cnic' => $user->guardian->cnic,
                'address' => $user->guardian->address,
            ] : null,
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}
