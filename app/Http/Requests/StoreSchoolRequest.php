<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'longitude' => 'nullable|numeric|between:-180,180',
            'latitude' => 'nullable|numeric|between:-90,90',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The school name is required.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
        ];
    }
}