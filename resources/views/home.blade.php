@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Profile Form -->
                        <div class="row mb-3">
                            <!-- Left Section: Profile Image and Name -->
                            <div class="col-md-4 d-flex flex-column align-items-center text-center">
                                <img src="{{ asset('images/users/' . Auth::user()->profile_pic) }}"
                                    alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                <h4>{{ Auth::user()->name }}</h4>

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger mt-3">Logout</button>
                                </form>
                            </div>

                            <!-- Right Section: Update Form -->
                            <div class="col-md-8">
                                <form method="POST" action="{{ route('update.profile', ['user' => Auth::id()]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end"
                                            style="font-size: 1.1rem;">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" required autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end"
                                            style="font-size: 1.1rem;">{{ __('Email Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email', Auth::user()->email) }}" required>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="profile_image" class="col-md-4 col-form-label text-md-end"
                                            style="font-size: 1.1rem;">{{ __('Profile Image') }}</label>

                                        <div class="col-md-6">
                                            <input id="profile_image" type="file"
                                                class="form-control @error('profile_image') is-invalid @enderror"
                                                name="profile_image">

                                            @error('profile_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <small class="form-text text-muted">Leave blank if you don’t want to change
                                                it.</small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end"
                                            style="font-size: 1.1rem;">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <small class="form-text text-muted">Leave blank if you don’t want to change
                                                it.</small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end"
                                            style="font-size: 1.1rem;">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password_confirmation" type="password" class="form-control"
                                                name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>


                                    <div class="row mb-2">
                                        <div class="col-md-8 offset-md-4">
                                            <div class="d-flex">
                                                <button type="submit" class="btn btn-primary me-2">
                                                    {{ __('Update Profile') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Separate Card for Account Deletion -->
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="text-danger">Danger Zone</h5>
                                <form action="{{ route('destroy.profile', ['user' => Auth::id()]) }}" method="post"
                                    id="delete-profile-form"
                                    onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
