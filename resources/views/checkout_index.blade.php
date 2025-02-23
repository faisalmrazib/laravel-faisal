@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Checkout</div>

                <div class="card-body">
                    <form id="checkoutForm">
                        @csrf

                        <!-- Input Produk -->
                        <div class="form-group mb-3">
                            <label for="product_id">Produk</label>
                            <select name="product_id" id="product_id" class="form-control" required>
                                @forelse ($cartItems as $item)
                                    <option value="{{ $item->product->id ?? '' }}">
                                        {{ $item->product->name ?? '-' }} - 
                                        Rp{{ number_format($item->product->price ?? 0, 0, ',', '.') }} -
                                        Jumlah: {{ $item->quantity ?? '-' }}
                                    </option>
                                @empty
                                    <option value="">Keranjang belanja kosong</option>
                                @endforelse
                            </select>
                        </div>

                        <!-- Input Quantity -->
                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                        </div>

                        <!-- Input Voucher -->
                        <div class="form-group mb-3">
                            <label for="voucher_code">Voucher Code</label>
                            <input type="text" name="voucher_code" id="voucher_code" class="form-control">
                        </div>

                        <!-- Input Alamat Pengiriman -->
                        <div class="form-group mb-3">
                            <label for="shipping_address">Alamat Pengiriman</label>
                            <textarea name="shipping_address" id="shipping_address" class="form-control" required></textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('checkoutForm').addEventListener('submit', function (e) {
    e.preventDefault();

    fetch("{{ route('checkout_store') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: document.getElementById('product_id').value || null,
            quantity: document.getElementById('quantity').value || 1,
            voucher_code: document.getElementById('voucher_code').value || null,
            shipping_address: document.getElementById('shipping_address').value || null,
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Checkout berhasil!');
            window.location.href = "{{ route('index_order') }}"; // Redirect ke halaman order
        } else {
            alert('Terjadi kesalahan: ' + JSON.stringify(data.errors));
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>
@endsection
