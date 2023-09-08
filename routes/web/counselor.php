<?php

use App\Http\Controllers\CounselorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'counselor', 'consent'])->group(function () {
    Route::get('/students/{highschool_id}', [CounselorController::class, 'students'])->name('counselor-students');
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
