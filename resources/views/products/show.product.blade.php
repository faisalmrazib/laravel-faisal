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
                            <img src="{{ url('storage/' . $product->image) }}" alt="{{ $product->name }}" width="200px">
                        </div>
                        <div class="">
                            <h1>{{ $product->name }}</h1>
                            <h6>{{ $product->description }}</h6>
                            <h3>Rp{{ number_format($product->price, 0, ',', '.') }}</h3>
                            <hr>
                            <p>{{ $product->stock }} left</p>
                            @if (!Auth::user()->is_admin)
                            <form action="{{ route('add_to_cart', $product) }}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" aria-describedby="basic-addon2" name="amount" value="1" min="1" max="{{ $product->stock }}" placeholder="Quantity">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Add to cart</button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="{{ route('edit_product', $product) }}" method="get">
                                <button type="submit" class="btn btn-primary">Edit product</button>
                            </form>
                            @endif
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
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