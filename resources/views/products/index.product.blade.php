@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Products') }}</h4>
                </div>

                    <form action="{{ route('index_product') }}"eth mod="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                
                <div class="card-body">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img class="card-img-top" src="{{ url('storage/' . $product->image) }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                                    <p class="card-text"><strong>Price:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                                </div>
                                <div class="card-footer bg-white">
                                <div class="d-flex justify-content-center mt-4">
                                {{ $product->links() }}
                                        <a href="{{ route('show_product', $product) }}" class="btn btn-primary btn-sm">Show Detail</a>
                                        @if (Auth::check() && Auth::user()->is_admin)
                                        <form action="{{ route('delete_product', $product) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection