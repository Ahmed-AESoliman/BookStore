<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'price' => 'required',
            'exchangable' => 'required|boolean',
            'negationable' => 'required|boolean',
            'state' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'sometimes|nullable|exists:sub_categories,id',
            'subject_id' => 'sometimes|nullable|exists:subjects,id',
            'attachments' => 'required|array|min:1|max:4',
        ];
    }
}
