<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $id = auth()->user()->id;
        return [
            'name' => 'required|string',
            'email' => 'required|email|max:255|unique:users' . ',email,' . $id,
            'mobile' => 'required|string|min:11|max:13|unique:users' . ',mobile_number,' . $id,
            'avatar' => 'nullable|string',
            // 'password' => 'required|min:8|confirmed',
            'city' => 'required|string|max:255',
            'town' => 'required|string|max:255',
        ];
    }
}
