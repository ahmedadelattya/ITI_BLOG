@extends('layouts.app')

@section('title')
    All posts
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create</a>
    </div>
    <table class="table">

        <tr>
            <th> ID</th>
            <th> Title</th>
            <th> Posted_By</th>
            <th>Created_at</th>
            <th>Actions</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['posted_by'] }}</td>
                <td>{{ $post['created_at'] }}</td>
                <td><a href="{{ route('posts.show', $post['id']) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-success">Edit</a>
                    <a href="{{ route('posts.delete', $post['id']) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
