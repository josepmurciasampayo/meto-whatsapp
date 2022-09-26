<?php

use App\Http\Controllers\ChatbotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('admin')->group(function() {
});
    Route::post('/resetChatbot', [ChatbotController::class, 'reset'])->name('resetChatbot');
    Route::post('/startChatbot', [ChatbotController::class, 'startLoop'])->name('startChatbot');

Route::post('/chat', [ChatbotController::class, 'listenToReply']);
