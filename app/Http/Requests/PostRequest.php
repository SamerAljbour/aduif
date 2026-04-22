<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'type' => 'required|in:news,memory',
            'event_date' => 'nullable|date',

            'image' => 'nullable|image|max:2048',

            // Arabic
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'nullable|string',

            // French
            'title_fr' => 'required|string|max:255',
            'description_fr' => 'nullable|string',
        ];
    }
}
