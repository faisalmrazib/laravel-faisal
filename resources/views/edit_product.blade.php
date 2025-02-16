@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Edit Product') }}</h4>
                </div>

                <div class="card-body">
                    <!-- Form Edit Produk -->
                    <form action="{{ route('update_product', $product->id) }}" method="PATCH">
    @csrf
    @method('PATCH') 
                        <!-- Input Nama Produk -->
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control" 
                                value="{{ old('name', $product->name) }}" 
                                required
                            >
                        </div>

                        <!-- Input Deskripsi Produk -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea 
                                name="description" 
                                id="description" 
                                class="form-control" 
                                required
                            >{{ old('description', $product->description) }}</textarea>
                        </div>

                        <!-- Input Harga Produk -->
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input 
                            type="text" 
                            name="price" 
                            id="price" 
                            placeholder="Product Price" 
                            class="form-control @error('price') is-invalid @enderror" 
                            oninput="formatPrice(this)"
                            step="0.01"  
                            value="{{ old('price', $product->price) }}"
                            required
                            >
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Stok Produk -->
                        <!-- Stock -->
                        <div class="form-group mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" name="stock" id="stock"  value="{{ old('stock', $product->stock ?? 0) }}"  placeholder="Product Stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Gambar Produk -->
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <input 
                                type="file" 
                                name="image" 
                                id="image" 
                                class="form-control"
                            >
                            @if ($product->image)
                                <img src="{{ url('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                            @endif
                        </div>

                        <!-- Tombol Submit -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="{{ route('index_product') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection