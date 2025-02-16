@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-deep-sea-blue text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Products') }}</h4>
                    @if (Auth::check() && Auth::user()->is_admin)
                        <a href="{{ route('create_product') }}" class="btn btn-matcha btn-sm">
                            <i class="fas fa-plus-circle me-2"></i>Create Product
                        </a>
                    @endif
                </div>

                <!-- Search Form -->
                <form action="{{ route('index_product') }}" method="GET" class="mb-4 p-3 bg-soft-white">
                    <div class="input-group">
                        
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-matcha">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                </form>

                <div class="card-body">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-md-3 mb-3">
                            <div class="card h-200 shadow-sm product-card">
                                <img class="card-img-top" src="{{ url('storage/images/' . $product->image) }}" alt="{{ $product->name }}" style="height: 400px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                                    <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('show_product', $product) }}" class="btn btn-matcha btn-sm">
                                            <i class="fas fa-eye me-2"></i>Detail
                                        </a>
                                        @if (Auth::check() && Auth::user()->is_admin)
                                        <form action="{{ route('delete_product', $product) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    :root {
        --matcha-green: #A8D8B9;
        --deep-sea-blue: #2E5266;
        --soft-white: #F5F5F5;
        --dark-charcoal: #333333;
    }

    .bg-deep-sea-blue {
        background-color: var(--deep-sea-blue);
    }

    .bg-soft-white {
        background-color: var(--soft-white);
    }

    .btn-matcha {
        background-color: var(--matcha-green);
        color: var(--deep-sea-blue);
        border: none;
        transition: transform 0.3s ease;
    }

    .btn-matcha:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(168, 216, 185, 0.3);
    }

    .product-card {
        background-color: #ffffff;
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
        border-radius: 10px 10px 0 0;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: var(--dark-charcoal);
    }

    .card-text {
        font-size: 0.9rem;
        color: var(--dark-charcoal);
    }

    .pagination .page-link {
        background-color: #ffffff;
        border: 1px solid rgba(46, 82, 102, 0.2);
        color: var(--deep-sea-blue);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--matcha-green);
        border-color: var(--matcha-green);
        color: var(--deep-sea-blue);
    }
</style>
@endsection