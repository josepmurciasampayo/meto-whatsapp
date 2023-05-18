<?php

use App\Http\Controllers\{AdminController, Auth\RegisteredUserController, CounselorController, HomeController};
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/form/{url}', '\App\Http\Controllers\UserFormController@show');
Route::post('/form', '\App\Http\Controllers\UserFormController@update');
Route::get('/thank-you', '\App\Http\Controllers\UserFormController@thankyou')->name('thankyou');
Route::get('reset-password/{token?}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
Route::get('terms', [\App\Http\Controllers\StaticController::class, 'terms'])->name('terms');
Route::get('privacy-policy', [\App\Http\Controllers\StaticController::class, 'privacy'])->name('privacy-policy');
Route::post('deploy', [\App\Http\Controllers\WebhookController::class, 'deploy']);
Route::get('contact', [\App\Http\Controllers\StaticController::class, 'contact'])->name('contact');
Route::post('contact', [\App\Http\Controllers\StaticController::class, 'contactStore'])->name('contact.store');
Route::get('contact-thankyou', [\App\Http\Controllers\StaticController::class, 'contactThanks'])->name('contact.thankyou');
Route::get('/signup', [\App\Http\Controllers\SignupController::class, 'home'])->name('signup');
Route::get('/signup-student', [\App\Http\Controllers\SignupController::class, 'student'])->name('signup.student');
Route::get('/signup-counselor', [\App\Http\Controllers\SignupController::class, 'counselor'])->name('signup.counselor');
Route::get('/signup-uni', [\App\Http\Controllers\SignupController::class, 'uni'])->name('signup.uni');
Route::post('/signup-uni', [\App\Http\Controllers\SignupController::class, 'uniStore'])->name('signup.uni.store');
Route::get('search-high-schools', [TypeaheadController::class, 'autocompleteSearch'])->name('search-high-schools'); //added for highschool typeahead


// Admin functionality
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/php-info', [AdminController::class, 'info'])->name('php-info');

    Route::get('/campaigns', '\App\Http\Controllers\CampaignController@show')->name('campaigns');
    Route::post('/campaigns', '\App\Http\Controllers\CampaignController@update');

    Route::get('/admin/matches', [AdminController::class, 'matchData'])->name('matchData');
    Route::get('/admin/matches/{id}', [CounselorController::class, 'matches'])->name('matches');

    Route::get('/comms-log', [AdminController::class, 'commsLog'])->name('comms-log');
    Route::post('/send-message', [AdminController::class, 'sendMessage'])->name('send-message');
    Route::post('/resetChatbot', [AdminController::class, 'resetChatbot'])->name('resetChatbot');
    Route::post('/startChatbot', [AdminController::class, 'startChatbot'])->name('startChatbot');

    Route::get('/admin/universities', [AdminController::class, 'universities'])->name('universities');
    Route::get('/admin/uni/{id}', [\App\Http\Controllers\UniController::class, 'get'])->name('uni');
    Route::get('/admin/new-uni', [\App\Http\Controllers\UniController::class, 'create'])->name('uni.create');
    Route::post('/admin/new-uni', [\App\Http\Controllers\UniController::class, 'store'])->name('uni.store');
    Route::post('/admin/uni-update', [\App\Http\Controllers\UniController::class, 'update'])->name('uni.update');

    Route::get('/admin/highschools', [AdminController::class, 'highschools'])->name('highschools');
    Route::post('/admin/mergeHS', [AdminController::class, 'mergeHS'])->name('mergeHS');
    Route::post('/admin/mergeHSconfirm', [AdminController::class, 'mergeHSconfirm'])->name('mergeHSconfirm');
    Route::get('/admin/students/{highschool_id?}', [AdminController::class, 'students'])->name('students');
    Route::get('/admin/logins', [AdminController::class, 'logins'])->name('logins');

    Route::get('/admin/questions', [AdminController::class, 'questions'])->name('questions');
    Route::get('/admin/question/{id?}', [AdminController::class, 'question'])->name('question');
    Route::post('/admin/question', [AdminController::class, 'questionStore'])->name('question.store');
    Route::get('/admin/questionCreate', [AdminController::class, 'question'])->name('question.create');
    Route::get('/admin/answers/{question_id}', [AdminController::class, 'answers'])->name('answers');

    Route::get('/admin/curricula', [AdminController::class, 'curricula'])->name('curricula');
    Route::get('/admin/curriculum/{curriculum}', [AdminController::class, 'curriculum'])->name('curriculum');

    Route::get('/admin/commands', [AdminController::class, 'commands'])->name('commands');
    Route::get('/admin/command', [AdminController::class, 'command'])->name('command');

    Route::get('/admin/databases', [AdminController::class, 'databases'])->name('databases');
    Route::get('/admin/workRequest', [AdminController::class, 'workRequest'])->name('workRequest');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('reports');
});

Route::middleware(['auth', 'terms', 'university'])->group(function() {
    Route::get('/student/{student_id}', [CounselorController::class, 'student'])->name('counselor-student');
});

// Counselor functionality
Route::middleware(['auth', 'counselor', 'terms'])->group(function () {
    Route::get('/students/{highschool_id}', [CounselorController::class, 'students'])->name('counselor-students');
    Route::get('/student/{student_id}', [CounselorController::class, 'student'])->name('counselor-student');
    Route::get('/student/{student_id}', [CounselorController::class, 'student'])->name('counselor-student');
    Route::post('/student', [CounselorController::class, 'saveVerify'])->name('saveVerify');

    Route::post('/saveNotes', [CounselorController::class, 'saveNotes'])->name('saveNotes');

    Route::get('/invite/{highschool_id}/{user_id?}', [CounselorController::class, 'invite'])->name('invite');
    Route::post('/invite', [CounselorController::class, 'sendInvite'])->name('sendInvite');

    Route::get('/matches/{highschool_id}', [CounselorController::class, 'matches'])->name('counselor-matches');
    Route::post('/matches', [CounselorController::class, 'saveMatches'])->name('saveStudentMatches');

    Route::get('/highschool/{highschool_id}', [CounselorController::class, 'highschool'])->name('highschool');
    Route::post('/highschool', [CounselorController::class, 'updateHighschool'])->name('highschool.update');

    Route::get('/student/fetch/{student}', [CounselorController::class, 'fetchStudent'])->name('student.fetch');

    Route::post('/remove/{student_id}', [CounselorController::class, 'remove'])->name('remove');
});

// Institution functionality
Route::middleware(['auth', 'terms', 'institution'])->group(function () {
});

// Redirects if already authenticated
Route::middleware('guest')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('user.register');
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/get-started', [\App\Http\Controllers\StudentController::class, 'getStarted'])->name('student.getStarted');
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

    Route::get('reset-pw', \App\Http\Controllers\Auth\getPasswordResetView::class);
    Route::post('reset-password', \App\Http\Controllers\Auth\updatePassword::class);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::get('profile/{user_id?}', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::post('profile', [\App\Http\Controllers\UserController::class, 'update'])->name('profile.update');

    Route::post('terms', [\App\Http\Controllers\StaticController::class, 'saveTerms'])->name('saveTerms');
});

require __DIR__ . '/web-student.php';
require __DIR__ . '/web-counselor.php';
require __DIR__ . '/web-uni.php';
