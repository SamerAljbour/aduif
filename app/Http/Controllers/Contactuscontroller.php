<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsNotification;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::latest()->paginate(10);

        return view('dashboard.contactUs.index', compact('contacts'));
    }
    /**
     * Store a new contact message.
     * Works for both AJAX (JSON) and standard form submissions.
     */
    public function store(ContactUsRequest $request): JsonResponse|RedirectResponse
    {
        try {

            // Save message
            $contactUs = ContactUs::create($request->validated());

            // Send email
            // Mail::to('aduif.jordanie@gmail.com')
            //     ->send(new ContactUsNotification($contactUs));

            // JSON response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your message has been sent successfully.',
                ]);
            }

            return back()->with(
                'success',
                'Thank you! Your message has been sent successfully.'
            );
        } catch (\Exception $e) {

            Log::error('Contact form error: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send message.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            return back()->with(
                'error',
                'Failed to send message.'
            );
        }
    }
}
