<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Show the change password form.
     */
    public function show()
    {
        return view('auth.change-password');
    }

    /**
     * Update the user's password.
     */
    public function update(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        // Update the password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
}
