<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $bookId = $this->route('book') ? $this->route('book')->id : null;

        return [
            'title' => 'required|string|max:255',
            'isbn' => [
                'required',
                'string',
                'regex:/^(?:ISBN(?:-1[03])?:?\s)?(?=[0-9X]{10}$|(?=(?:[0-9]+[-\s]){3})[-\s0-9X]{13}$|97[89][0-9]{10}$|(?=(?:[0-9]+[-\s]){4})[-\s0-9]{17}$)(?:97[89][-\s]?)?[0-9]{1,5}[-\s]?[0-9]+[-\s]?[0-9]+[-\s]?[0-9X]$/i',
                Rule::unique('books', 'isbn')->ignore($bookId),
            ],
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
            'pages' => 'nullable|integer|min:1',
            'author_id' => 'required|exists:authors,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Book title is required',
            'isbn.required' => 'ISBN is required',
            'isbn.regex' => 'Please provide a valid ISBN format (e.g., 978-3-16-148410-0 or 0-306-40615-2)',
            'isbn.unique' => 'This ISBN already exists',
            'author_id.required' => 'Please select an author',
            'author_id.exists' => 'Selected author does not exist',
            'pages.min' => 'Pages must be at least 1',
        ];
    }
}
