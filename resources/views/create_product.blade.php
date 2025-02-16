@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-deep-sea-blue text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Create Product') }}</h4>
                    <a href="{{ route('index_product') }}" class="btn btn-matcha btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Back to Products
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold text-dark-charcoal">Product Name</label>
                            <input type="text" name="name" id="name" 
                                   class="form-control rounded-3 @error('name') is-invalid @enderror" 
                                   placeholder="Enter product name"
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold text-dark-charcoal">Description</label>
                            <textarea name="description" id="description" 
                                      class="form-control rounded-3 @error('description') is-invalid @enderror" 
                                      placeholder="Enter product description"
                                      rows="4"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price & Stock -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold text-dark-charcoal">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-soft-white text-dark-charcoal">$ us</span>
                                    <input type="text" name="price" id="price" 
                                           class="form-control rounded-3 @error('price') is-invalid @enderror" 
                                           placeholder="Enter price"
                                           oninput="formatPrice(this)"
                                           value="{{ old('price') }}" 
                                           required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-bold text-dark-charcoal">Stock</label>
                                <input type="number" name="stock" id="stock" 
                                       class="form-control rounded-3 @error('stock') is-invalid @enderror" 
                                       placeholder="Enter stock quantity"
                                       value="{{ old('stock', 0) }}" 
                                       min="0"
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold text-dark-charcoal">Product Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="image" 
                                       class="form-control rounded-3 @error('image') is-invalid @enderror"
                                       accept="image/*"
                                       required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Recommended size: 800x800 pixels</small>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-matcha btn-lg rounded-3 fw-bold">
                                <i class="fas fa-plus-circle me-2"></i>Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

    .btn-matcha {
        background-color: var(--matcha-green);
        color: var(--deep-sea-blue);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-matcha:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(168, 216, 185, 0.3);
    }

    .form-control {
        background-color: var(--soft-white);
        border: 2px solid rgba(46, 82, 102, 0.1);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--matcha-green);
        box-shadow: 0 0 0 3px rgba(168, 216, 185, 0.1);
    }

    .text-dark-charcoal {
        color: var(--dark-charcoal);
    }

    .bg-soft-white {
        background-color: var(--soft-white);
    }
</style>

<script>
    function formatPrice(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        let numberValue = parseInt(value, 10);
        
        if (!isNaN(numberValue)) {
            input.value = numberValue.toLocaleString('id-ID');
        } else {
            input.value = '';
        }
    }

    // Form validation
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection