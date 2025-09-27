<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGuardianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->guardian->user_id),
            ],
            'phone' => 'required|string|max:20',
            // Password optional on update, but when present must be confirmed
            'password' => 'nullable|min:6|confirmed',
            'cnic' => [
                'required',
                'string',
                'max:15',
                Rule::unique('guardians', 'cnic')->ignore($this->guardian->id),
            ],
            'address' => 'nullable|string|max:255',
        ];
    }
}
