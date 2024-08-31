<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;



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
    Route::put('/profile/{user}', [UserController::class, 'update'])->name('update.profile');
    Route::delete('/profile/{user}', [UserController::class, 'destroy'])->name('destroy.profile');
});



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Login with github



Route::get('/auth/redirect', function () {
    //    return "github";
    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/auth/callback', function () {

    // return "redirected";
    // $user = Socialite::driver('github')->stateless()->user();
    // dd($user);
    // if user exists --> login .. if not register then login
    $githubUser = Socialite::driver('github')->stateless()->user();
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'password' => $githubUser->token,
        'github_token' => $githubUser->token,
        'profile_pic' => $githubUser->getAvatar(),
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/home');
});
