<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\SectionController;

Route::apiResource('class-sessions', ClassSessionController::class);
Route::apiResource('class', ClassController::class);
Route::apiResource('section', SectionController::class);


// Route::get('/class-sessions', [ClassSessionController::class, 'index']);
// Route::post('/class-sessions', [ClassSessionController::class, 'store']);
