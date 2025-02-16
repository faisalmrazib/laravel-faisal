<!-- resources/views/profile/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Profile') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h3 class="mb-3">{{ Auth::user()->name }}</h3>
                            <p class="text-muted"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p class="text-muted"><strong>Role:</strong> {{ Auth::user()->is_admin ? 'Admin' : 'User' }}</p>
                            <p class="text-muted"><strong>Joined:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('edit_profile') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection