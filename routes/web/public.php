<?php

use App\Http\Controllers\{
    Auth\MetoWelcomeController,
    Auth\WelcomeController,
    HomeController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\TypeaheadController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('form/{url}', '\App\Http\Controllers\UserFormController@show');
Route::post('form', '\App\Http\Controllers\UserFormController@update');
Route::get('thank-you', '\App\Http\Controllers\UserFormController@thankyou')->name('thankyou');
Route::get('reset-password/{token?}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
Route::get('terms', [\App\Http\Controllers\StaticController::class, 'terms'])->name('terms');
Route::get('consent', [\App\Http\Controllers\StaticController::class, 'consent'])->name('consent');
Route::get('consent-student', [\App\Http\Controllers\StaticController::class, 'consentStudent'])->name('consent.student');
Route::get('consent-university', [\App\Http\Controllers\StaticController::class, 'consentUni'])->name('consent.uni');
Route::get('consent-highschool', [\App\Http\Controllers\StaticController::class, 'consentHS'])->name('consent.HS');
Route::get('privacy-student', [\App\Http\Controllers\StaticController::class, 'privacyStudent'])->name('privacy.student');
Route::get('privacy', [\App\Http\Controllers\StaticController::class, 'privacy'])->name('privacy');
Route::post('deploy', [\App\Http\Controllers\WebhookController::class, 'deploy']);
Route::get('contact', [\App\Http\Controllers\StaticController::class, 'contact'])->name('contact');
Route::post('contact', [\App\Http\Controllers\StaticController::class, 'contactStore'])->name('contact.store');
Route::get('contact-thankyou', [\App\Http\Controllers\StaticController::class, 'contactThanks'])->name('contact.thankyou');
Route::get('signup', [\App\Http\Controllers\SignupController::class, 'home'])->name('signup');
Route::get('signup-student', [\App\Http\Controllers\SignupController::class, 'student'])->name('signup.student');
Route::get('signup-counselor', [\App\Http\Controllers\SignupController::class, 'counselor'])->name('signup.counselor');
Route::get('signup-uni', [\App\Http\Controllers\SignupController::class, 'uni'])->name('signup.uni');
Route::post('signup-uni', [\App\Http\Controllers\SignupController::class, 'uniStore'])->name('signup.uni.store');
Route::get('search-high-schools', [TypeaheadController::class, 'autocompleteSearch'])->name('search-high-schools'); //added for highschool typeahead
Route::get('welcome/{user}', [MetoWelcomeController::class, 'showWelcomeForm'])->name('welcome');
Route::post('welcome/{user}', [MetoWelcomeController::class, 'savePassword']);
