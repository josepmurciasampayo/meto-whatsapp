<?php


use App\Http\Controllers\TypeaheadController;
use Illuminate\Support\Facades\Route;

// Unathenticated routes
Route::get('/get-started', [\App\Http\Controllers\StudentController::class, 'getStarted'])->name('student.getStarted');
Route::get('/transfer', [\App\Http\Controllers\StudentController::class, 'transfer'])->name('student.transfer');

Route::middleware(['auth', 'terms', 'student'])->group(function () {
    Route::post('/hsLookup', [TypeaheadController::class, 'autocompleteSearch'])->name('hsLookup');

    Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);
    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('student.home');
    Route::get('/edit-info', [\App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
    Route::get('/intro', [\App\Http\Controllers\StudentController::class, 'intro'])->name('student.intro');
    Route::get('/student-profile', [\App\Http\Controllers\StudentController::class, 'profile'])->name('student.profile');
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
});
