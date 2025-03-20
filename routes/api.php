<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/users/register', [UserController::class, 'register'])->name('api.register');
Route::post('/users/login', [UserController::class, 'login'])->name('api.login');

// Authenticated routes
Route::middleware('auth:sanctum')->group(function() {

    // User routes
    Route::get('/users', [UserController::class, 'index']);
    Route::patch('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/users/me', [UserController::class, 'me']);
    Route::post('/users/logout', [UserController::class, 'logout']);

    // Post routes
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'createPost']);
    Route::get('/posts/{id}', [PostController::class, 'getOnePost']);
    Route::post('/posts/{id}', [PostController::class, 'updatePost']);
    Route::post('/posts/{id}/delete', [PostController::class, 'deletePost']);
});
