<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function (Request $request) {

    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {

    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
