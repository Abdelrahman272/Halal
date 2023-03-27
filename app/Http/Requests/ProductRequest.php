<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'photos' => 'required|array',
            'photos.*' => 'required|image|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required',
            'category_id' => 'required',
        ];
    }
}
