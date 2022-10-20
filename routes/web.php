<?php

use App\Http\Controllers\{AdminController, CounselorController, HomeController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\TypeaheadController;

// Unauthenticated routes
Route::get('/form/{url}', '\App\Http\Controllers\UserFormController@show');
Route::post('/form', '\App\Http\Controllers\UserFormController@update');
Route::get('/thank-you', '\App\Http\Controllers\UserFormController@thankyou')->name('thankyou');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('reset-password/{token?}', [NewPasswordController::class, 'create'])
    ->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');

// Admin functionality
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/php-info', [AdminController::class, 'info'])->name('php-info');
    Route::get('/campaigns', '\App\Http\Controllers\CampaignController@show')->name('campaigns');
    Route::post('/campaigns', '\App\Http\Controllers\CampaignController@update');
    Route::get('/admin/matches', [AdminController::class, 'matchData'])->name('matchData');
    Route::get('/comms-log', [AdminController::class, 'commsLog'])->name('comms-log');
    Route::post('/send-message', [AdminController::class, 'sendMessage'])->name('send-message');
    Route::post('/resetChatbot', [AdminController::class, 'resetChatbot'])->name('resetChatbot');
    Route::post('/startChatbot', [AdminController::class, 'startChatbot'])->name('startChatbot');
    Route::get('/admin/universities', [AdminController::class, 'universities'])->name('universities');
    Route::get('/admin/highschools', [AdminController::class, 'highschools'])->name('highschools');
    Route::get('/admin/students', [AdminController::class, 'students'])->name('students');
    Route::get('/admin/matches/{id}', [CounselorController::class, 'matches'])->name('matches');
    Route::get('/admin/logins', [AdminController::class, 'logins'])->name('logins');
    Route::get('/admin/questions', [AdminController::class, 'questions'])->name('questions');
    Route::get('/admin/answers/{question_id}', [AdminController::class, 'answers'])->name('answers');
});

// Counselor functionality
Route::middleware(['auth', 'counselor'])->group(function() {
    Route::get('/students/{highscool_id}', [CounselorController::class, 'students'])->name('counselor-students');
    Route::get('/student/{student_id}', [CounselorController::class, 'student'])->name('counselor-student');
    Route::post('/student', [CounselorController::class, 'saveProfile'])->name('saveStudentProfile');

    Route::post('/saveNotes', [CounselorController::class, 'saveNotes'])->name('saveNotes');

    Route::get('/invite/{highschool_id}', [CounselorController::class, 'invite'])->name('invite');
    Route::post('/invite', [CounselorController::class, 'sendInvite'])->name('sendInvite');

    Route::get('/matches/{highschool_id}', [CounselorController::class, 'matches'])->name('counselor-matches');
    Route::post('/matches', [CounselorController::class, 'saveMatches'])->name('saveStudentMatches');

    Route::get('/highschool/{id}', [CounselorController::class, 'highschool'])->name('highschool');
    Route::post('/highschool', [CounselorController::class, 'update'])->name('highschool.update');
});

// Student functionality
Route::middleware('student')->group(function() {
    Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);
});

// Institution functionality
Route::middleware('institution')->group(function() {

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

    Route::get('profile/{user_id?}', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::post('profile', [\App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
});
