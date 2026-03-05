<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'gte:min_price'],
            'categories' => ['nullable', 'string'], // ID категории или несколько через запятую
        ];
    }

    public function messages(): array
    {
        return [
            'min_price.numeric' => 'The minimum price must be a number.',
            'max_price.numeric' => 'The maximum price must be a number.',
            'max_price.gte' => 'The maximum price must be greater than or equal to the minimum price.',
        ];
    }
}
