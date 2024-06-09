<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArtRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo' => 'required|array|min:1|max:5',
            'title' => 'required|string|min:3|max:50',
            'category_id' => 'required|exists:categories,category_id',
            'description' => 'required|text|min:3|max:200',
            'medium' => 'required|string|min:3|max:20',
            'material' => 'required|string|min:3|max:20',
            'price' => 'required|integer',
            'length' => 'required|integer',
            'width' => 'required|integer',
            'stock' => 'required|integer',
            'year' => 'required|integer|min:1100|max:2024',
        ];
    }
}
