<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJoinRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            // 🔹 Basic
            'name_fr' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'nationality' => 'required|in:jordanian,non_jordanian',

            // 🔹 Files
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:10240',

            // 🔹 Multi docs
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:10240',

            // 🔹 Translation - French
            'specialization_fr' => 'nullable|string',
            'graduation_university_fr' => 'nullable|string',
            'current_job_fr' => 'nullable|string',
            'workplace_fr' => 'nullable|string',
            'interests_fr' => 'nullable|string',
            'bio_fr' => 'nullable|string',

            // 🔹 Translation - Arabic
            'specialization_ar' => 'nullable|string',
            'graduation_university_ar' => 'nullable|string',
            'current_job_ar' => 'nullable|string',
            'workplace_ar' => 'nullable|string',
            'interests_ar' => 'nullable|string',
            'bio_ar' => 'nullable|string',

            // 🔹 Degree (shared)
            'degree' => 'nullable|string',
        ];
    }
}
