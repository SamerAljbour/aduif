<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:100'],
            'email'   => ['required', 'email:rfc,dns', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your name.',
            'name.min'         => 'Your name must be at least 2 characters.',
            'email.required'   => 'Please enter your email address.',
            'email.email'      => 'Please enter a valid email address.',
            'message.required' => 'Please enter your message.',
            'message.min'      => 'Your message must be at least 10 characters.',
        ];
    }
}
