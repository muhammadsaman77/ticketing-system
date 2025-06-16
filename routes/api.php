<?php

use App\Http\Controllers\Api\AuthController;
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
