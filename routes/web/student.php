<?php

use App\Http\Controllers\{
    Auth\WelcomeController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeaheadController;

// Unathenticated routes
Route::get('/transfer', [\App\Http\Controllers\StudentController::class, 'transfer'])->name('student.transfer');
Route::post('/transfer', [\App\Http\Controllers\StudentController::class, 'storeTransfer'])->name('student.transfer');

Route::middleware(['auth', 'consent', 'student'])->group(function () {
    Route::post('/hsLookup', [TypeaheadController::class, 'autocompleteSearch'])->name('hsLookup');
    Route::post('/orgLookup', [TypeaheadController::class, 'autocompleteOrgSearch'])->name('orgLookup');

    Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);
    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('student.home');
    Route::get('/edit-info', [\App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
    //Route::get('/student-profile', [\App\Http\Controllers\StudentController::class, 'profile'])->name('student.profile');
    Route::get('/student-profile', [\App\Http\Controllers\StudentController::class, 'profile'])->name('student.profile');
    Route::post('/student-profile', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'update'])->name('user.update');
    Route::get('/demographic', [\App\Http\Controllers\StudentController::class, 'demographic'])->name('student.demographic');
    Route::get('/highschool', [\App\Http\Controllers\StudentController::class, 'highschool'])->name('student.highschool');
    Route::get('/academics/{screen?}', [\App\Http\Controllers\StudentController::class, 'academics'])->name('student.academics');
    Route::get('/financial', [\App\Http\Controllers\StudentController::class, 'financial'])->name('student.financial');
    Route::get('/extracurricular', [\App\Http\Controllers\StudentController::class, 'extracurricular'])->name('student.extracurricular');
    Route::get('/university', [\App\Http\Controllers\StudentController::class, 'university'])->name('student.university');
    Route::get('/testing', [\App\Http\Controllers\StudentController::class, 'testing'])->name('student.testing');
    Route::get('/general', [\App\Http\Controllers\StudentController::class, 'general'])->name('student.general');

    Route::post('/inviteFriends', [\App\Http\Controllers\StudentController::class, 'invite'])->name('inviteFriends');

    Route::post('/handle', [\App\Http\Controllers\StudentController::class, 'handle'])->name('student.handle');

    Route::post('/connection-request/{studentUniversity}/question/ask', [\App\Http\Controllers\StudentConnectionController::class, 'ask'])->name('question.ask');
    Route::post('/connection-request/{studentUniversity}/student/decide', [\App\Http\Controllers\StudentConnectionController::class, 'decide'])->name('question.ask');
});
