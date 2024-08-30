@extends('layouts.app')
@section('title')
    Create_Post
@endsection

@section('content')
    <h1 style="text-align: center"> Add new Post</h1>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create Post</h4>
                <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}">
                    @csrf
                    <!-- Title input -->
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter the title"
                            name="title" value="{{ old('title') }}">
                    </div>
                    @error('title')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    <!-- Description textarea -->
                    <div class="mb-3">
                        <label for="postDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="postDescription" rows="4" placeholder="Enter the description"
                            name="description">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    <!-- Image input -->
                    <div class="mb-3">
                        <label for="postImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="postImage" name="image">
                    </div>
                    @error('image')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
