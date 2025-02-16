@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product Detail') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <div class="">
                        <img class="card-img-top" src="{{ url('storage/images/' . $product->image) }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">                        </div>
                        <div class="">
                            <h1>{{ $product->name }}</h1>
                            <h6>{{ $product->description }}</h6>
                            <h3>${{ number_format($product->price, 0, ',', '.') }}</h3>
                            <hr>
                            <p>{{ $product->stock }} left</p>
                            @if (!Auth::user()->is_admin)
                                <form action="{{ route('add_to_cart', $product) }}" method="POST">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="amount">Jumlah:</label>
                                        <input type="number" name="amount" id="amount" class="form-control" value="1" min="1" max="{{ $product->stock ?? PHP_INT_MAX }}">                                    <button type="submit" class="btn btn-primary mt-2">Add to Cart</button>
                                </form>
                            @else
                                <p>Silakan <a href="{{ route('register') }}">register</a> untuk menambahkan produk ke keranjang.</p>
                            @endif
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection