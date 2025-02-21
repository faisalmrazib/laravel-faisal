<!-- resources/views/profile/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <h2 class="stext-106 cl6 hov1 bor3 trans-04">Profile</h2>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="bg-soft-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="stext-104 cl4">{{ Auth::user()->name }}</h3>
                            <p class="stext-105 cl3"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p class="stext-105 cl3"><strong>Role:</strong> <span class="cl1">{{ Auth::user()->is_admin ? 'Admin' : 'User' }}</span></p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('edit_profile') }}" class="btn btn-matcha">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
