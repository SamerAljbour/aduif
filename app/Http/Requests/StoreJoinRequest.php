<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJoinRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            // Basic
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'nationality' => 'required|in:jordanian,non_jordanian',

            // Files
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',

            // Multi docs
            'documents' => 'required|array|min:1',
            'documents.*' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:10240',

            // Source-language content
            'specialization' => 'required|string',
            'graduation_university' => 'required|string',
            'current_job' => 'required|string',
            'workplace' => 'required|string',
            'interests' => 'required|string',
            'bio' => 'required|string',

            // Degree (shared enum value)
            'degree' => 'required|string',
        ];
    }
}
