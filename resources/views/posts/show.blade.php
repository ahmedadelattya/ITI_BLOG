@extends('layouts.app')

@section('title')
    Post_Details
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">Post Info</h5>
        <div class="card-body">
            <h5 class="card-title"><strong>Title: </strong>{{ $post->title }}</h5>
            <p class="card-text"><strong>Description: </strong>{{ $post->description }}</p>
            <p class="card-text"><strong>Posted_By: </strong>{{ $post->posted_by }}</p>
            <p class="card-text">
                <strong>Created At:</strong> {{ $post->created_at->toDayDateTimeString() }}
            </p>
            <p class="card-text">
                <strong>Updated At:</strong> {{ $post->updated_at->diffForHumans() }}
            </p>
        </div>
    </div>
@endsection
