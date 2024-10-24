<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\S3CheckController;

Route::post('/upload', S3CheckController::class)->name('upload.file');

Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
