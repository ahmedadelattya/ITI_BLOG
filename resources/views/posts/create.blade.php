@extends('layouts.app')
@section('title')
    Create_Post
@endsection

@section('content')
    <h1 style="text-align: center"> Add new Post</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create Post</h4>
                <form method="post" action="{{ route('posts.store') }}">
                    @csrf
                    <!-- Title input -->
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter the title"
                            name="title" value="{{ old('title') }}">
                    </div>

                    <!-- Description textarea -->
                    <div class="mb-3">
                        <label for="postDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="postDescription" rows="4" placeholder="Enter the description"
                            name="description">{{ old('description') }}</textarea>
                    </div>

                    <!-- Post creator dropdown -->
                    <div class="mb-3">
                        <label for="postCreator" class="form-label">Post Creator</label>
                        <select class="form-select" id="postCreator" name="posted_by">
                            <option selected disabled>Choose a creator</option>
                            <option value="ahmed" {{ old('posted_by') == 'ahmed' ? 'selected' : '' }}>Ahmed</option>
                            <option value="mohamed" {{ old('posted_by') == 'mohamed' ? 'selected' : '' }}>Mohamed</option>
                            <option value="adel" {{ old('posted_by') == 'adel' ? 'selected' : '' }}>Adel</option>
                            <option value="omar" {{ old('posted_by') == 'omar' ? 'selected' : '' }}>Omar</option>
                        </select>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
