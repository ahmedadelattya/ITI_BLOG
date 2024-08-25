@extends('layouts.app')

@section('title')
    Edit_Post
@endsection

@section('content')
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
                <h4 class="card-title mb-4">Edit Post</h4>
                <form method="post" action="{{ route('posts.update', $post['id']) }}">
                    @csrf
                    <!-- Title input -->
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter the title"
                            value="{{ $post['title'] }}" name="title">
                    </div>

                    <!-- Description textarea -->
                    <div class="mb-3">
                        <label for="postDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="postDescription" rows="4"
                            placeholder="Enter the description">{{ $post['description'] }}</textarea>
                    </div>

                    <!-- Post creator dropdown -->
                    <div class="mb-3">
                        <label for="postCreator" class="form-label">Post Creator</label>
                        <select class="form-select" id="postCreator" name="posted_by">
                            <option value="Ahmed" {{ $post['posted_by'] == 'ahmed' ? 'selected' : '' }}>Ahmed</option>
                            <option value="Mohamed" {{ $post['posted_by'] == 'mohamed' ? 'selected' : '' }}>Mohamed</option>
                            <option value="Adel" {{ $post['posted_by'] == 'adel' ? 'selected' : '' }}>Adel</option>
                            <option value="Omar" {{ $post['posted_by'] == 'omar' ? 'selected' : '' }}>Omar</option>
                        </select>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
