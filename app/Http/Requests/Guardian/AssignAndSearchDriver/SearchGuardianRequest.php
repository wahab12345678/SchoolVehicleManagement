<?php

namespace App\Http\Requests\Guardian\AssignAndSearchDriver;

use Illuminate\Foundation\Http\FormRequest;

class SearchGuardianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasAnyRole(['guardian', 'parent', 'admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'area' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'vehicle_type' => 'nullable|string|in:all,van,bus,car,rickshaw',
            'min_capacity' => 'nullable|integer|min:1|max:100',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'area.max' => 'The area name may not exceed 100 characters.',
            'vehicle_type.in' => 'Please select a valid vehicle type (Van, Bus, Car, or Rickshaw).',
            'min_capacity.integer' => 'Minimum capacity must be a valid number.',
        ];
    }
}
