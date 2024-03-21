<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:users,email|max:255',
            'mobile_number' => 'required|unique:users,mobile_number|min:11|max:13',
            'password' => 'required|min:8|confirmed',
            'city' => 'required|string|max:255',
            'town' => 'required|string|max:255',
        ];
    }
}
