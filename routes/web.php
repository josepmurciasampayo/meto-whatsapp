<?php

use App\Http\Controllers\{AdminController, CounselorController, HomeController, InstitutionController, StudentController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;

// Unauthenticated routes
Route::get('/form/{url}', '\App\Http\Controllers\UserFormController@show');
Route::post('/form', '\App\Http\Controllers\UserFormController@update');
Route::get('/thank-you', '\App\Http\Controllers\UserFormController@thankyou')->name('thankyou');
Route::get('/php-info', [AdminController::class, 'info'])->name('php-info');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin functionality
Route::middleware('admin')->group(function() {
    Route::get('/logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
    Route::get('/campaigns', '\App\Http\Controllers\ChatCampaignController@show')->name('campaigns');
    Route::post('/campaigns', '\App\Http\Controllers\ChatCampaignController@update');
    Route::get('/test', [AdminController::class, 'index'])->name('admin-home');
});

// Counselor functionality
Route::middleware('counselor')->group(function() {
    Route::get('/students', [CounselorController::class, 'students'])->name('counselor-students');
    Route::get('/school-profile', [CounselorController::class, 'profile'])->name('counselor-school');
    Route::get('/connections', [CounselorController::class, 'connections'])->name('counselor-connections');
});

// Student functionality
Route::middleware('student')->group(function() {

});

// Institution functionality
Route::middleware('student')->group(function() {

});

// Redirects if already authenticated
Route::middleware('guest')->group(function () {
/*
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
*/
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

// Any signed-in user
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

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);
});
