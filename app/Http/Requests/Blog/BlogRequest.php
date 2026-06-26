<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'shortDescription' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'photo' => 'nullable|string_with_max',
        ];
    }
}
