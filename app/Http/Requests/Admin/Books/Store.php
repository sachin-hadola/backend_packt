<?php

namespace App\Http\Requests\Admin\Books;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'title' => 'required|max:120',
            'author' => 'required|max:120',
            'genre' => 'required|max:100',
            'description' => 'required',
            'isbn' => 'required|numeric|unique:books,isbn',
            'image' => 'required|url',
            'published_on' => 'required|date|date_format:Y-m-d|before:tomorrow',
            'publisher' => 'required|max:150'
        ];
    }
}
