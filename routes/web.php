<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\JoinRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');

    Route::resource('managements', ManagementController::class);
    Route::resource('posts', PostController::class);
    Route::resource('projects', ProjectController::class);
    Route::get('join-requests', [JoinRequestController::class, 'adminIndex'])
        ->name('joinRequests.index');

    Route::post('join-requests/{id}/approve', [JoinRequestController::class, 'approve'])
        ->name('joinRequests.approve');
    Route::post('join-requests/{id}/reject', [JoinRequestController::class, 'reject'])
        ->name('joinRequests.reject');
    Route::get('members', [MemberController::class, 'index'])
        ->name('members.index');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('/join-us', [JoinRequestController::class, 'index'])->name('admin.dashboard');
Route::middleware(['locale'])->group(function () {

    Route::resource('join-us', JoinRequestController::class);

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('members', [MemberController::class, 'showMembers'])
        ->name('members.showMembers');
    Route::get('managers', [ManagementController::class, 'showManagement'])
        ->name('managements.showManagers');

    // Route::get('/about', function () {
    //     return view('about');
    // });
});


Route::get('set-locale/{lang}', function ($lang) {
    if (in_array($lang, ['fr', 'ar'])) {
        session(['locale' => $lang]);
    }

    return back();
})->name('set.locale');
require __DIR__ . '/auth.php';
