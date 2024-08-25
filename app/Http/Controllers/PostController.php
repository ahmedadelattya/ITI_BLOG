<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    private $posts = [
        [
            "id" => 1,
            "title" => "Learn PHP",
            "posted_by" => "Ahmed",
            "created_at" => "2018-04-10",
            "description" => "An introductory guide to learning PHP, covering the basics and essential concepts for beginners."
        ],
        [
            "id" => 2,
            "title" => "SOLID Principles",
            "posted_by" => "Mohamed",
            "created_at" => "2018-04-11",
            "description" => "A comprehensive overview of the SOLID principles in software development, explaining how to create more maintainable and scalable code."
        ],
        [
            "id" => 3,
            "title" => "Design Patterns",
            "posted_by" => "Adel",
            "created_at" => "2018-04-12",
            "description" => "An exploration of common design patterns in object-oriented programming, with practical examples and use cases."
        ],
        [
            "id" => 4,
            "title" => "OOP",
            "posted_by" => "Omar",
            "created_at" => "2018-04-13",
            "description" => "An in-depth look at Object-Oriented Programming (OOP), covering key concepts like inheritance, polymorphism, and encapsulation."
        ]
    ];


    // contains functions --> manage actions
    function index()
    {
        $posts = Post::all();
        return view("posts.index", ["posts" => $posts]);
    }

    function create()
    {
        //
        return view("posts.create");
    }

    function store()
    {
        $valid_data = request()->validate([
            "title" => "required|unique:posts",
            "description" => "required",
            "posted_by" => "required"
        ]);
        $request_data = request()->all(); # get request parameter
        # if form is not valid  --> redirect to the html page
        $post = new Post();
        $post->title = $request_data['title'];
        $post->description = $request_data['description'];
        $post->posted_by = $request_data['posted_by'];
        $post->save();
        return to_route("posts.show", $post->id);
    }
    function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return view("posts.show", ["post" => $post]);
        }

        abort(404); # return with page 404 not found
    }
    function edit($id)
    {
        //
        $post = Post::find($id);
        if ($post) {
            return view("posts.edit", ["post" => $post]);
        }

        abort(404); # return with page 404 not found
    }

    function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();  # delete from posts where id=id;
            return to_route("posts.index");
        }
        abort(404);
    }

    function update($id)
    {
        // Validate the incoming request
        $valid_data = request()->validate([
            "title" => "required|unique:posts",
            "description" => "required",
            "posted_by" => "required"
        ]);
        //get request parameter
        $request_data = request()->all();
        // Find the post by its ID
        $post = Post::findOrFail($id);

        // Update the post's fields with validated data
        $post->title = $request_data['title'];
        $post->description = $request_data['description'];
        $post->posted_by = $request_data['posted_by'];

        // Save the changes to the database
        $post->save();

        // Redirect to the post's show page
        return to_route("posts.show", $post->id);
    }
}
