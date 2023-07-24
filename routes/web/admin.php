<?php

use App\Http\Controllers\{
    AdminController,
    Auth\WelcomeController,
    CounselorController,
    CurriculumController,
    HighSchoolController
};
use Illuminate\Support\Facades\Route;

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

    Route::get('/admin/highschools', [HighSchoolController::class, 'index'])->name('highschools');
    Route::post('/admin/mergeHS', [HighSchoolController::class, 'merge'])->name('mergeHS');
    Route::post('/admin/mergeHSconfirm', [HighSchoolController::class, 'mergeConfirm'])->name('mergeHSconfirm');
    Route::get('/admin/students/{highschool_id?}', [HighSchoolController::class, 'students'])->name('students');

    Route::get('/admin/logins', [AdminController::class, 'logins'])->name('logins');

    Route::resource('questions', \App\Http\Controllers\QuestionController::class);
    Route::resource('equivalencies', \App\Http\Controllers\EquivalencyController::class);
    Route::get('connections', [\App\Http\Controllers\ConnectionController::class, 'index'])->name('connections.index');
    Route::resource('curriculum', CurriculumController::class);

    Route::get('/admin/answers/{question_id}', [AdminController::class, 'answers'])->name('answers');

    Route::get('/admin/commands', [AdminController::class, 'commands'])->name('commands');
    Route::get('/admin/command', [AdminController::class, 'command'])->name('command');

    Route::get('/admin/databases', [AdminController::class, 'databases'])->name('databases');
    Route::get('/admin/workRequest', [AdminController::class, 'workRequest'])->name('workRequest');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('reports');

    Route::post('/connections/{connection}/approve', [AdminController::class, 'approveConnection']);
    Route::post('/connections/{connection}/deny', [AdminController::class, 'denyConnection']);

    Route::post('/admin/student/{student}/delete', [AdminController::class, 'deleteStudent'])->name('admin.student.delete');
});
