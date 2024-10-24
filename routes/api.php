<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\S3CheckController;

Route::post('/check-s3', S3CheckController::class);
Route::get('/files', [S3CheckController::class,'getFiles']);