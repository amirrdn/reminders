<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api'])->group(function() {
    Route::post('/auth',[AuthController::class, 'login']);
    Route::get('/unauthenticated',[AuthController::class, 'unauthenticated'])->name('unauthenticated');
    Route::middleware('auth:api')->group(function() {
        Route::put('/session',[AuthController::class, 'refresh']);
        Route::post('/reminders', [TaskController::class, 'store']);
        Route::get('/reminders/{id}', [TaskController::class, 'view']);
        Route::put('/reminders/{id}', [TaskController::class, 'update']);
        Route::delete('/reminders/{id}', [TaskController::class, 'destroy']);
    });
});