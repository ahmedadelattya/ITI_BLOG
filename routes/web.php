<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;


Route::redirect('/', '/home');
// Publicly accessible routes
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Authenticated accessible routes
Route::middleware('auth')->group(function () {
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/reset', [PostController::class, 'reset'])->name('posts.reset');
});



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
