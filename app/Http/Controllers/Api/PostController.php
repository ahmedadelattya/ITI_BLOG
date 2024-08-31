<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum')->except(["index", "show"]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $image_path = $post->image;
        if ($request->hasFile('image')) {
            Storage::disk('posts_images')->delete($image_path);
            $image = $request->file('image');
            $image_path = $image->store("", 'posts_images');
        }
        $request_data = request()->all();
        $request_data['image'] = $image_path; # replace image object with image_uploaded path
        $request_data['user_id'] = Auth::id(); // Set the user ID for the post
        $post->update($request_data);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        if ($post->image) {
            Storage::disk('posts_images')->delete($post->image);
        }

        $post->delete();
        return response()->json(
            ["deleted" => "success"],
            204
        );
    }
}
