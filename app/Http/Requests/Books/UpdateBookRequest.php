<?php

namespace App\Http\Requests\Books;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'synopsis' => ['sometimes', 'string', 'min:100'],
            'genre_id' => ['sometimes', 'exists:genres,id'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['exists:tags,id'],
            'content_rating' => ['sometimes', 'in:everyone,teen,mature'],
            'cover_image' => ['sometimes', 'string'],
        ];
    }
}
