<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('dashboard');

// Protected routes
Route::middleware('auth')->group(function() {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/logout', [UserController::class, 'webLogout'])->name('logout');

    Route::get('/newsFeed', [PostController::class, 'showNewsFeed'])->name('newsFeed');
    Route::get('/posts', [PostController::class, 'showCreatePost'])->name('createPost');
    Route::post('/posts', [PostController::class, 'createPost'])->name('createPost.submit');

    Route::get('/posts/{id}', [PostController::class, 'showUpdatePost'])->name('updatePost');
    Route::post('/posts/{id}', [PostController::class, 'updatePost'])->name('updatePost.submit');
    
    // Add these new routes for PUT and DELETE methods
    Route::put('/posts/{id}', [PostController::class, 'updatePost'])->name('updatePost.put');
    Route::delete('/posts/{id}/delete', [PostController::class, 'deletePost'])->name('deletePost');
    
    // Add route for toggling post likes
    Route::post('/posts/{id}/like', [PostController::class, 'toggleLike'])->name('posts.like');
});