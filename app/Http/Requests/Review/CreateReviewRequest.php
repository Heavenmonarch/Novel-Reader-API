<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'book_id' => ['required', 'exists:books,id'],
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'body'    => ['sometimes', 'nullable', 'string', 'min:10', 'max:1000'],
        ];
    }
}
