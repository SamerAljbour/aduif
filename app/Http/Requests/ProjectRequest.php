<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{



    public function rules(): array
    {
        return [
            'status' => 'required|in:coming_soon,active,completed',

            'title' => 'required|string|max:255',
            'description' => 'required|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}
