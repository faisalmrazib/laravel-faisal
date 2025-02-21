@extends('layouts.app')

@section('content')
<div class="container p-t-80 p-b-50">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="p-l-40 p-r-40 p-t-30 p-b-30 bor10 bg0 m-lr-auto shadow-lg">
                <h4 class="mtext-109 cl2 text-center p-b-20">Create Product</h4>
                <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <!-- Name -->
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-20" type="text" name="name" id="name" 
                               placeholder="Enter product name" value="{{ old('name') }}" required>
                    </div>

                    <!-- Description -->
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <textarea class="stext-111 cl2 plh3 size-120 p-l-20" name="description" id="description" 
                                  placeholder="Enter product description" required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Price & Stock -->
                    <div class="row">
                        <div class="col-md-6 m-b-20">
                            <div class="bor8 how-pos4-parent">
                                <input class="stext-111 cl2 plh3 size-116 p-l-20" type="text" name="price" id="price" 
                                       placeholder="Enter price" oninput="formatPrice(this)" value="{{ old('price') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-20">
                            <div class="bor8 how-pos4-parent">
                                <input class="stext-111 cl2 plh3 size-116 p-l-20" type="number" name="stock" id="stock" 
                                       placeholder="Enter stock quantity" value="{{ old('stock', 0) }}" min="0" required>
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="m-b-20">
                        <label class="stext-111 cl2 p-b-10">Product Image</label>
                        <input type="file" name="image" id="image" accept="image/*" class="size-116" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex-c-m m-t-30">
                        <button type="submit" class="flex-c-m stext-101 cl0 size-103 bg3 bor1 hov-btn3 p-lr-15 trans-04">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
</script>
@endsection
