<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGuardianRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => 'required|string|max:20',
            // Password required on create and must be confirmed
            'password' => 'required|min:6|confirmed',
            'cnic' => ['required', 'string', 'max:15', Rule::unique('guardians', 'cnic')],
            'address' => 'nullable|string|max:255',
        ];
    }

}
