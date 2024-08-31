<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Rules\MaxPosts;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{

    // Displays a paginated list of posts
    public function index()
    {
        $posts = Post::paginate(4);
        return view("posts.index", compact('posts'));
    }

    // Shows the form for creating a new post
    public function create()
    {
        $this->authorize('create', Post::class);
        $users = User::all();
        return view("posts.create");
    }

    // Stores a newly created post in the database
    public function store(StorePostRequest $request)
    {
        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store("", 'posts_images');
        }

        $request_data = $request->all();
        $request_data['image'] = $image_path; // Replace image object with image path
        $request_data['user_id'] = Auth::id(); // Set the user ID for the post

        $post = Post::create($request_data);
        return to_route('posts.show', $post);
    }

    // Displays the specified post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Shows the form for editing the specified post
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $users = User::all();
        return view("posts.edit", compact('post', 'users'));
    }

    // Updates the specified post in the database
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $image_path = $post->image;
        if ($request->hasFile('image')) {
            # delete old_image
            if (Storage::disk('posts_images')->exists($image_path)) {
                Storage::disk('posts_images')->delete($image_path);
            }
            $image = $request->file('image');
            $image_path = $image->store("", 'posts_images');
        }

        $request_data = $request->all();
        $request_data['image'] = $image_path;
        $request_data['user_id'] = Auth::id(); // Set the user ID for the post
        $post->update($request_data);
        return to_route('posts.show', $post);
    }

    // Deletes the specified post from the database
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        // Delete the post from the database
        $post->delete();

        // Redirect with a success message
        return to_route('posts.index')->with('success', 'Post deleted successfully');
    }

    // Restores all soft-deleted posts
    public function reset()
    {
        $this->authorize('restore', Post::class);

        Post::onlyTrashed()->restore();

        // Redirect back to the index page with a success message
        return to_route('posts.index')->with('success', 'All deleted posts have been restored successfully.');
    }
}
