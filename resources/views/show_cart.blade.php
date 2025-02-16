@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cart') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @php
                    $total_price = 0;
                    @endphp

                    <div class="row">
                        @foreach ($carts as $cart)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="{{ url('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $cart->product->name }}</h5>
                                    <p class="card-text">${{ number_format($cart->product->price, 0, ',', '.') }}</p>
                                    <form action="{{ route('update_cart', $cart) }}" method="post" class="mb-2">
                                        @method('patch')
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="amount" value="{{ $cart->amount }}" min="1" max="{{ $cart->product->stock }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{ route('delete_cart', $cart) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @php
                        $total_price += $cart->product->price * $cart->amount;
                        @endphp
                        @endforeach
                    </div>

                    <div class="d-flex flex-column justify-content-end align-items-end mt-4">
                        <p class="h4">Total: ${{ number_format($total_price, 0, ',', '.') }}</p>
                        @if ($carts->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Your cart is empty.
                        </div>
                        @else
                        <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection