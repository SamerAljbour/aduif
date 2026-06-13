<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // main table
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:30',
            'position' => 'required|string|max:255',
            'type' => 'required|in:current,former,honorary,consultant',


            // translated content
            'name' => 'required_without:translations|string|max:255',
            'bio'  => 'required_without:translations|string',
            'translations' => 'nullable|array',
            'translations.en.name' => 'required_with:translations|string|max:255',
            'translations.en.bio' => 'required_with:translations|string',
            'translations.ar.name' => 'required_with:translations|string|max:255',
            'translations.ar.bio' => 'required_with:translations|string',
            'translations.fr.name' => 'required_with:translations|string|max:255',
            'translations.fr.bio' => 'required_with:translations|string',
        ];
    }
}
