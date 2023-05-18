<?php

use App\Http\Controllers\TypeaheadController;
use Illuminate\Support\Facades\Route;

// Unathenticated routes

Route::middleware(['auth', 'terms', 'university'])->group(function () {
    Route::get('/welcome', [\App\Http\Controllers\UniController::class, 'welcome'])->name('uni.welcome');
    Route::get('/uni-name', [\App\Http\Controllers\UniController::class, 'name'])->name('uni.name');
    Route::post('/uni-name', [\App\Http\Controllers\UniController::class, 'nameStore'])->name('uni.name.store');
    Route::get('/uni-homepage', [\App\Http\Controllers\UniController::class, 'homepage'])->name('uni.homepage');
    Route::post('/uni-homepage', [\App\Http\Controllers\UniController::class, 'homepageStore'])->name('uni.homepage.store');
    Route::get('/uni-application', [\App\Http\Controllers\UniController::class, 'application'])->name('uni.application');
    Route::post('/uni-application', [\App\Http\Controllers\UniController::class, 'applicationStore'])->name('uni.application.store');
    Route::get('/uni-location', [\App\Http\Controllers\UniController::class, 'location'])->name('uni.location');
    Route::post('/uni-location', [\App\Http\Controllers\UniController::class, 'locationStore'])->name('uni.location.store');
    Route::get('/uni-efc', [\App\Http\Controllers\UniController::class, 'efc'])->name('uni.efc');
    Route::post('/uni-efc', [\App\Http\Controllers\UniController::class, 'efcStore'])->name('uni.efc.store');
    Route::get('/uni-home', [\App\Http\Controllers\UniController::class, 'home'])->name('uni.home');
    Route::get('/uni-mingrade', [\App\Http\Controllers\UniController::class, 'mingrade'])->name('uni.mingrade');
    Route::post('/uni-mingrade', [\App\Http\Controllers\UniController::class, 'mingradeStore'])->name('uni.mingrade.store');
    Route::get('/uni-myprofile', [\App\Http\Controllers\UniController::class, 'myProfile'])->name('uni.myprofile');
    Route::post('/uni-myprofile', [\App\Http\Controllers\UniController::class, 'myProfileStore'])->name('uni.myprofile.store');
    Route::get('/uni-profile', [\App\Http\Controllers\UniController::class, 'uniProfile'])->name('uni.uniprofile');
    Route::post('/uni-profile', [\App\Http\Controllers\UniController::class, 'uniProfileStore'])->name('uni.uniprofile.store');
    Route::get('/uni-connections', [\App\Http\Controllers\UniController::class, 'connections'])->name('uni.connections');

    Route::get('/uni-efcgrades', [\App\Http\Controllers\UniController::class, 'efcGrades'])->name('uni.efcgrades');
    Route::post('/uni-efcgrades', [\App\Http\Controllers\UniController::class, 'efcGradesStore'])->name('uni.efcgrades.store');
    Route::get('/uni-newuser', [\App\Http\Controllers\UniController::class, 'newUser'])->name('uni.newuser');
    Route::post('/uni-newuser', [\App\Http\Controllers\UniController::class, 'newUserStore'])->name('uni.newuser.store');

    Route::post('connection/decide', [\App\Http\Controllers\UniController::class, 'decide'])->name('uni.connection.decide');
    Route::get('/uni-student-fetch/{student}', [\App\Http\Controllers\UniController::class, 'fetchStudent'])->name('uni.student.fetch');
});
