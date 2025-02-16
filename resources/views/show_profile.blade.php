@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                    @endif

                    <form action="{{ route('edit_profile') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                        
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

