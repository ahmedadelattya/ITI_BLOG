<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Handle profile image upload
        $image_path = $user->profile_pic; // Default to current profile picture
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists
            if (Storage::disk('users_images')->exists($image_path)) {
                Storage::disk('users_images')->delete($image_path);
            }
            // Store the new image
            $image = $request->file('profile_image');
            $image_path = $image->store("", 'users_images');
        }

        // Prepare the request data, excluding the password fields
        $request_data = $request->except('password', 'password_confirmation');

        // Check if a new password is provided
        if ($request->filled('password')) {
            $request_data['password'] = Hash::make($request->input('password')); // Hash and add new password
        }

        // Update profile picture path if a new image is uploaded
        $request_data['profile_pic'] = $image_path;

        // Update user data only with fields that are not empty
        $user->update($request_data);

        return redirect()->route('home')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Handle profile picture deletion if it exists
        if ($user->profile_pic) {
            $oldImagePath =  $user->profile_pic;
            # delete old_image
            if (Storage::disk('users_images')->exists($oldImagePath)) {
                Storage::disk('users_images')->delete($oldImagePath);
            }
        }

        // Delete the user
        $user->delete();

        // Logout the user
        Auth::logout();

        return redirect()->route('login');
    }
}
