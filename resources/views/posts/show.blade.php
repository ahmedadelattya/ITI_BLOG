@extends('layouts.app')

@section('title')
    Post Details
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <!-- Left Section: Post Details -->
            <div class="col-md-{{ $post->user && $post->user->posts->count() > 1 ? '6' : '12' }} d-flex">
                <div class="card mb-3 shadow flex-fill d-flex flex-column">
                    <!-- Image Section -->
                    <div class="img-container mb-3" style="width: 100%; height: 200px; overflow: hidden;">
                        <img src="{{ asset('images/posts/' . $post->image) }}" class="img-fluid rounded" alt="postImage"
                            style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <!-- Description Section -->
                    <div class="card-body flex-grow-1 d-flex flex-column justify-content-center">
                        <h5 class="card-title text-center">{{ $post->title }}</h5>
                        <p class="card-text text-center">{{ $post->description }}</p>
                    </div>
                    <!-- Footer Section -->
                    <div class="d-flex flex-column p-3 mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <!-- Buttons Section on the Left -->
                            <div class="d-flex">
                                @if (Auth::check() && Auth::user()->id === $post->user_id)
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary me-2">Edit</a>
                                @endif
                                <a href="{{ route('posts.index') }}" class="btn btn-secondary ">Back</a>

                            </div>
                            <!-- Post Information Section on the Right -->
                            <div>
                                <p class="card-text mb-0">
                                    <small class="text-muted">Posted By: {{ $post->user->name }}</small>
                                </p>
                                <p class="card-text mb-0">
                                    <small class="text-muted">Last updated: {{ $post->human_readable_updated_at }}</small>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Right Section: Other Posts by the Same User -->
            @if ($post->user && $post->user->posts->count() > 1)
                <div class="col-md-6 d-flex">
                    <div class="card mb-3 shadow flex-fill">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $post->user->name }} Other Posts</h5>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionOtherPosts">
                                @foreach ($post->user->posts as $pst)
                                    @if ($pst->id != $post->id)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $pst->id }}">
                                                <button class="accordion-button text-start collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $pst->id }}"
                                                    aria-expanded="false" aria-controls="collapse{{ $pst->id }}">
                                                    {{ $pst->title }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $pst->id }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $pst->id }}"
                                                data-bs-parent="#accordionOtherPosts">
                                                <div class="accordion-body">
                                                    <div class="img-container mb-3"
                                                        style="width: 100%; height: 200px; overflow: hidden;">
                                                        <img src="{{ asset('images/posts/' . $pst->image) }}"
                                                            class="img-fluid rounded" alt="postImage"
                                                            style="width: 100%; height: 100%; object-fit: contain;">
                                                    </div>
                                                    {{ $pst->description }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
