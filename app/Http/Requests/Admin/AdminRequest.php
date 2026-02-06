<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email')->ignore($this->route('admin')),
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ];

        // Create specific rules
        if ($this->isMethod('POST')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        return $rules;
    }
}
