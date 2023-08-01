<?php

use App\Http\Controllers\{
    Auth\RegisteredUserController,
    Auth\WelcomeController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

// Any Unauthenticated user
Route::middleware('guest')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('user.register');
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/get-started', [\App\Http\Controllers\StudentController::class, 'getStarted'])->name('student.getStarted');
});
