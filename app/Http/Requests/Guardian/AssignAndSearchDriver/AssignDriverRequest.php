<?php

namespace App\Http\Requests\Guardian\AssignAndSearchDriver;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AssignDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if (!$user || !$user->hasAnyRole(['guardian', 'parent', 'admin'])) {
            return false;
        }

        $guardian = $user->guardian;
        if (!$guardian) {
            // Allow admin to assign drivers for any student
            return $user->hasRole('admin');
        }

        // Admin can assign driver to any student
        if ($user->hasRole('admin')) {
            return Student::where('id', $this->input('student_id'))->exists();
        }

        // Verify that the student being assigned belongs to the authenticated guardian
        return $guardian->students()->where('id', $this->input('student_id'))->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|integer|exists:students,id',
            'driver_id' => [
                'required',
                'integer',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $driver = User::find($value);
                    if (!$driver || !$driver->hasRole('driver')) {
                        $fail('The selected user is not a valid driver or rider.');
                    }
                },
            ],
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $driverId = $this->input('driver_id');
            if ($driverId) {
                $driver = User::role('driver')->with('vehicles')->find($driverId);
                $vehicle = $driver?->vehicles->first();
                if ($vehicle) {
                    $currentOccupancy = Student::where('driver_id', $driverId)->count();
                    $maxCapacity = $vehicle->capacity; // Car max 5, etc.
                    if ($currentOccupancy >= $maxCapacity) {
                        $typeLabel = ucfirst($vehicle->type ?? 'Vehicle');
                        $validator->errors()->add(
                            'driver_id',
                            "Vehicle capacity limit reached! This {$typeLabel} cannot exceed {$maxCapacity} passengers ({$currentOccupancy}/{$maxCapacity} occupied)."
                        );
                    }
                }
            }
        });
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'student_id.required' => 'Please select the student/child you wish to assign a rider to.',
            'student_id.exists' => 'The selected student is invalid or does not belong to your account.',
            'driver_id.required' => 'Please select an available driver or rickshaw rider.',
            'driver_id.exists' => 'The selected driver could not be found.',
        ];
    }
}
