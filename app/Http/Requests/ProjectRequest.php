<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{



    public function rules(): array
    {
        return [
            'status' => 'required|in:coming_soon,active,completed',

            'title' => 'required_without:translations|string|max:255',
            'description' => 'required_without:translations|string',
            'translations' => 'nullable|array',
            'translations.en.title' => 'required_with:translations|string|max:255',
            'translations.en.description' => 'required_with:translations|string',
            'translations.ar.title' => 'required_with:translations|string|max:255',
            'translations.ar.description' => 'required_with:translations|string',
            'translations.fr.title' => 'required_with:translations|string|max:255',
            'translations.fr.description' => 'required_with:translations|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}
