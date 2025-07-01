<?php

use App\Http\Controllers\Web\HandlerController;
use App\Http\Controllers\Web\SubmissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function (Request $request) {

    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('dashboard', function () {

        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::prefix('submissions')->group(function () {
        Route::get('/', [SubmissionController::class, 'index'])->name('submissions.index');
    });
    Route::prefix('handlers')->group(function () {
        Route::get('/', [HandlerController::class, 'index'])->name('handlers.index');
        Route::post('/', [HandlerController::class, 'store'])->name('handlers.store');
    });
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
