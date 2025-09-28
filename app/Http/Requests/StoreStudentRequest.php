<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // authorization handled elsewhere
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'roll_number' => 'nullable|string|max:50',
            'class' => 'nullable|string|max:50',
            'parent_id' => 'nullable|exists:guardians,id',
        ];
    }
}
