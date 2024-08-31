<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/hello", function () {
    return "hello";
});
Route::apiResource("/post", PostController::class);
// Route::get('/post/{post:slug}', [PostController::class, 'show']); //in Order To use Slug instead of id


####### Authenticate APIs
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        //        throw ValidationException::withMessages([
        //            'email' => ['The provided credentials are incorrect.'],
        //        ]);
        return response()->json(['message' => 'Invalid Credentials'], 422);
    }
    # limit creation no of token
    if ($user->tokens()->count() < 3) {
        return $user->createToken($request->device_name)->plainTextToken;
    }
    return response()->json(['message' => 'Maximum accounts reached please logout from one of them'], 422);
});



Route::post("/sanctum/logout", function () {
    $user = Auth::user();
    # remove all tokens
    $user->tokens()->delete();
    # remove current token
    //$user->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out successfully'], 200);
})->middleware('auth:sanctum');
