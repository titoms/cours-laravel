<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users/register', [UserController::class, 'register']);
Route::patch('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Route login
// Route logout
// Route /me
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/users/me', [UserController::class, 'me']);
});

