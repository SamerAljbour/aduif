<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{



    public function rules(): array
    {
        return [
            'status' => 'required|in:coming_soon,active,completed',

            'title_ar' => 'required|string|max:255',
            'title_fr' => 'required|string|max:255',

            'description_ar' => 'required|string',
            'description_fr' => 'required|string',
        ];
    }
}
