<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // authorization handled elsewhere
    }

    protected function prepareForValidation()
    {
        // DB column is roll_number; accept registration_no as an alias
        if (!$this->filled('roll_number') && $this->filled('registration_no')) {
            $this->merge(['roll_number' => $this->input('registration_no')]);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:2',
            'roll_number' => 'nullable|string|max:50|unique:students,roll_number',
            'registration_no' => 'nullable|string|max:50',
            'class' => 'nullable|string|max:50',
            'parent_id' => 'nullable|exists:guardians,id',
            'school_id' => 'nullable|exists:schools,id',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Student name is required.',
            'name.min' => 'Student name must be at least 2 characters.',
            'name.max' => 'Student name cannot exceed 255 characters.',
            'roll_number.unique' => 'This roll / registration number is already taken.',
            'roll_number.max' => 'Roll number cannot exceed 50 characters.',
            'class.max' => 'Class name cannot exceed 50 characters.',
            'parent_id.exists' => 'Selected guardian does not exist.',
            'school_id.exists' => 'Selected school does not exist.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
        ];
    }
}
