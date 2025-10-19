<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $studentId = $this->route('student');
        return [
            'name' => 'required|string|max:255|min:2',
            'roll_number' => 'nullable|string|max:50|unique:students,roll_number,' . $studentId,
            'registration_no' => 'nullable|string|max:50|unique:students,registration_no,' . $studentId,
            'class' => 'nullable|string|max:50',
            'parent_id' => 'nullable|exists:guardians,id',
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
            'roll_number.unique' => 'This roll number is already taken.',
            'roll_number.max' => 'Roll number cannot exceed 50 characters.',
            'class.max' => 'Class name cannot exceed 50 characters.',
            'parent_id.exists' => 'Selected guardian does not exist.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
        ];
    }
}
