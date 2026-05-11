<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        ContactUs::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully.',
            ]);
        }

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
