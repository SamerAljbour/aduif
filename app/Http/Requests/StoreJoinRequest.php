<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJoinRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            // 🔹 Basic
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'nationality' => 'required|in:jordanian,non_jordanian',

            // 🔹 Files
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:10240',

            // 🔹 Multi docs
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:10240',

            // 🔹 Translation
            'specialization' => 'nullable|string',
            'degree' => 'nullable|string',
            'graduation_university' => 'nullable|string',
            'current_job' => 'nullable|string',
            'workplace' => 'nullable|string',
            'interests' => 'nullable|string',
            'bio' => 'nullable|string',
        ];
    }
}
