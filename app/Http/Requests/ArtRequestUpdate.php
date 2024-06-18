<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArtRequestUpdate extends FormRequest
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
            'photo' => 'array|min:1|max:5|',
            'photo.*' => 'image|max:2048',
            'title' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3|max:200',
            'medium' => 'required|string|min:3|max:20',
            'material' => 'required|string|min:3|max:20',
            'price' => 'required|integer|min:1',
            'length' => 'required|integer|min:1',
            'width' => 'required|integer|min:1',
            'stock' => 'required|integer|min:1',
            'year' => 'required|integer|min:1100|max:2024',
        ];
    }
}
