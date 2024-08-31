@extends('layouts.app')

@section('title')
    All posts
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-center mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create</a>
        @auth
            <!-- Reset Button -->
            <form action="{{ route('posts.reset') }}" method="post" class="ms-2">
                @csrf
                <button type="submit" class="btn btn-warning"
                    onclick="return confirm('Are you sure you want to restore all deleted posts?');">
                    Reset
                </button>
            </form>
        @endauth
    </div>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th class="col text-center align-middle">ID</th>
                <th class="col text-center align-middle">Title</th>
                <th class="col text-center align-middle">Slug</th>
                <th class="col text-center align-middle">Image</th>
                <th class="col text-center align-middle">Posted By</th>
                <th class="col text-center align-middle">Created At</th>
                <th class="col text-center align-middle">View</th>
                @auth
                    <th class="col text-center align-middle">Edit</th>
                    <th class="col text-center align-middle">Delete</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="text-center align-middle">
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>
                        <img src="{{ asset('images/posts/' . $post->image) }}"
                            style="width: 100px; height: 100px; object-fit: contain;" alt="postImage" class="img-fluid">
                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->human_readable_created_at }}</td>
                    <td><a href="{{ route('posts.show', $post) }}" class="btn btn-info">View</a></td>
                    @auth
                        <td>
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-success">Edit</a>
                            @else
                                <a href="#" class="btn btn-success disabled" aria-disabled="true">Edit</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            @else
                                <button class="btn btn-danger" disabled>Delete</button>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection
