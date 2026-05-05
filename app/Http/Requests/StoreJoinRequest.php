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
            'phone' => 'required|string|max:20',
            'nationality' => 'required|in:jordanian,non_jordanian',

            // 🔹 Files
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',

            // 🔹 Multi docs
            'documents' => 'required|array|min:1',
            'documents.*' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:10240',

            // 🔹 Translation - French
            'specialization_fr' => 'required|string',
            'graduation_university_fr' => 'required|string',
            'current_job_fr' => 'required|string',
            'workplace_fr' => 'required|string',
            'interests_fr' => 'required|string',
            'bio_fr' => 'required|string',

            // 🔹 Translation - Arabic
            'specialization_ar' => 'required|string',
            'graduation_university_ar' => 'required|string',
            'current_job_ar' => 'required|string',
            'workplace_ar' => 'required|string',
            'interests_ar' => 'required|string',
            'bio_ar' => 'required|string',

            // 🔹 Degree (shared)
            'degree' => 'required|string',
        ];
    }
}
