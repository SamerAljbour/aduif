<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of pending users.
     */
    public function index(): View
    {
        $pendingUsers = User::where('status', 'pending')
            ->latest()
            ->paginate(15);

        $approvedUsers = User::where('status', 'approved')
            ->latest()
            ->paginate(15);

        $rejectedUsers = User::where('status', 'rejected')
            ->latest()
            ->paginate(15);

        return view('dashboard.users.index', compact('pendingUsers', 'approvedUsers', 'rejectedUsers'));
    }

    /**
     * Approve a user registration.
     */
    public function approve(User $user): RedirectResponse
    {
        // Only allow the specific admin email to perform approvals
        if (!auth()->check() || auth()->user()->email !== 'aduif.jordanie@gmail.com') {
            return back()->with('error', 'You are not authorized to approve users.');
        }

        // Prevent acting on self
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot approve your own account.');
        }

        if ($user->status === 'approved') {
            return back()->with('error', 'User is already approved.');
        }

        $user->update([
            'status' => 'approved',
            'is_active' => true,
        ]);

        return back()->with('success', 'User ' . $user->name . ' has been approved successfully.');
    }

    /**
     * Reject a user registration.
     */
    public function reject(User $user): RedirectResponse
    {
        // Only allow the specific admin email to perform rejections
        if (!auth()->check() || auth()->user()->email !== 'aduif.jordanie@gmail.com') {
            return back()->with('error', 'You are not authorized to reject users.');
        }

        // Prevent acting on self
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot reject your own account.');
        }

        if ($user->status === 'rejected') {
            return back()->with('error', 'User is already rejected.');
        }

        $user->update([
            'status' => 'rejected',
            'is_active' => false,
        ]);

        return back()->with('success', 'User ' . $user->name . ' has been rejected.');
    }

    /**
     * Reactivate a rejected user.
     */
    public function reactivate(User $user): RedirectResponse
    {
        // Only allow the specific admin email to perform reactivation
        if (!auth()->check() || auth()->user()->email !== 'aduif.jordanie@gmail.com') {
            return back()->with('error', 'You are not authorized to reactivate users.');
        }

        // Prevent acting on self
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot reactivate your own account.');
        }

        if ($user->status !== 'rejected') {
            return back()->with('error', 'Only rejected users can be reactivated.');
        }

        $user->update([
            'status' => 'approved',
            'is_active' => true,
        ]);

        return back()->with('success', 'User ' . $user->name . ' has been reactivated.');
    }

    /**
     * Deactivate an approved user (set is_active = false).
     */
    public function deactivate(User $user): RedirectResponse
    {
        if (!auth()->check() || auth()->user()->email !== 'aduif.jordanie@gmail.com') {
            return back()->with('error', 'You are not authorized to deactivate users.');
        }

        // Prevent acting on self
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }

        if ($user->status !== 'approved' || !$user->is_active) {
            return back()->with('error', 'Only active approved users can be deactivated.');
        }

        $user->update([
            'is_active' => false,
        ]);

        return back()->with('success', 'User ' . $user->name . ' has been deactivated.');
    }

    /**
     * Activate an approved user (set is_active = true).
     */
    public function activate(User $user): RedirectResponse
    {
        if (!auth()->check() || auth()->user()->email !== 'aduif.jordanie@gmail.com') {
            return back()->with('error', 'You are not authorized to activate users.');
        }

        // Prevent acting on self
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot activate your own account.');
        }

        if ($user->status !== 'approved' || $user->is_active) {
            return back()->with('error', 'Only inactive approved users can be activated.');
        }

        $user->update([
            'is_active' => true,
        ]);

        return back()->with('success', 'User ' . $user->name . ' has been activated.');
    }
}
