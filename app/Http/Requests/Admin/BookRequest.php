<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    // Validasi form buku
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:books,slug,' . $this->route('book')?->id,
            'description' => 'required|string',
            'cover_image' => 'nullable|image|max:2048', // 2MB Max
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }
}
