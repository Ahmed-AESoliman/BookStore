<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFilterRequest extends FormRequest
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
            "title" => "sometimes|string|nullable",
            "city" => "sometimes|string|nullable",
            "town" => "sometimes|string|nullable",
            "price" => "sometimes|array|nullable|min:2|max:2",
            "price.*" => "decimal:1,2",
            "state" => "sometimes|boolean|nullable",
            "category" => "sometimes|nullable|exists:categories,id",
            // "category.*" => "exists:categories,id",
            // "sub_category" => "sometimes|nullable|exists:sub_categories,id",
            // "sub_category.*" => "exists:sub_categories,id",
            // "subject" => "sometimes|nullable|array",
            // "subject.*" => "exists:subjects,id",
            "is_educational" => "sometimes|nullable|in:1,2",
            'authenticatedUserArea' => "sometimes|nullable|boolean"
        ];
    }
}
