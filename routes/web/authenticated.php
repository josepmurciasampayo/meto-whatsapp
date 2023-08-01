<?php

use App\Http\Controllers\{
    Auth\WelcomeController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::get('reset-pw', \App\Http\Controllers\Auth\getPasswordResetView::class);


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::get('profile/{user_id?}', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::post('profile', [\App\Http\Controllers\UserController::class, 'update'])->name('profile.update');

    Route::post('terms', [\App\Http\Controllers\StaticController::class, 'saveTerms'])->name('saveTerms');
    Route::post('consent', [\App\Http\Controllers\StaticController::class, 'saveConsent'])->name('saveConsent');
});
