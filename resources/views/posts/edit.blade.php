@extends('layouts.app')

@section('title')
    Edit Post
@endsection

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Post</h4>
                <form method="POST" enctype="multipart/form-data" action="{{ route('posts.update', $post) }}">
                    @csrf
                    @method('PUT')

                    <!-- Title input -->
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter the title"
                            name="title" value="{{ old('title', $post->title) }}">
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
                            name="description">{{ old('description', $post->description) }}</textarea>
                    </div>
                    @error('description')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    <!-- Current Image -->
                    @if ($post->image)
                        <div class="mb-3">
                            <label for="currentImage" class="form-label">Current Image</label>
                            <div>
                                <img src="{{ asset('images/posts/' . $post->image) }}"
                                    style="width: 100px; height: 100px; object-fit: contain;" alt="Current post image">
                            </div>
                        </div>
                    @endif

                    <!-- Image input -->
                    <div class="mb-3">
                        <label for="postImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="postImage" name="image">
                        <small class="form-text text-muted">Leave empty if you don't want to update the image.</small>

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
