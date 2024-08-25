<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::redirect('/', '/posts');
Route::get("/posts", [PostController::class, "index"])->name("posts.index");
Route::get("/create_post", [PostController::class, "create"])->name("posts.create");
Route::get("/show_post/{id}", [PostController::class, "show"])->name("posts.show");
Route::get("/edit_post/{id}", [PostController::class, "edit"])->name("posts.edit");
Route::get("/delete_post/{id}", [PostController::class, "delete"])->name("posts.delete");

# http request method --> post
Route::post("/students", [PostController::class, "store"])->name("posts.store");
Route::post("/update_post/{id}", [PostController::class, "update"])->name("posts.update");
