<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/', function () {
    return 'hello';
});
Route::post('/register', [AuthController::class, 'register'])->name('register-api');
Route::post('/login', [AuthController::class, 'login'])->name('login-api');

Route::middleware('auth:api')->group(function () {
    Route::prefix('/tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index']);
        Route::post('/', [TicketController::class, 'store']);
        Route::post('/rating', [TicketController::class, 'rating']);
    });
    Route::post('/change-password', [AuthController::class, 'changePassword']);
});
