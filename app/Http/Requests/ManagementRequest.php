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


            // translations
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'required|string|max:255',
            'bio_ar'  => 'required|string',
            'bio_fr'  => 'required|string',
        ];
    }
}
