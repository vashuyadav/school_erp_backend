<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ClassMappingController;
use App\Http\Controllers\SubjectTypeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectMappingController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::apiResource('class-sessions', ClassSessionController::class);
Route::apiResource('class', ClassController::class);
Route::apiResource('section', SectionController::class);
Route::apiResource('class-mapping', ClassMappingController::class);
Route::apiResource('subject-type', SubjectTypeController::class);
Route::apiResource('subject', SubjectController::class);
Route::apiResource('subject-mapping', SubjectMappingController::class);


// Route::get('/class-sessions', [ClassSessionController::class, 'index']);
// Route::post('/class-sessions', [ClassSessionController::class, 'store']);
