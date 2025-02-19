@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Keranjang Belanja</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($cartItems->isEmpty())
    <div class="alert alert-warning">
        Keranjang belanja Anda kosong.
    </div>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            @foreach($cartItems as $cartItem)
            <!-- Tampilkan item cart -->
            @endforeach

            <p></p>

            @foreach($cartItems as $item)

            <tr>
                <td>{{ $item->product->name ?? "Tidak dikenal" }}</td>
                <td>${{ number_format($item->product->price ?? NULL, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('update_cart', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $item->quantity ?? NULL }}" min="1" class="form-control" style="width: 80px;">
                        <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                    </form>
                </td>
                <form action="{{ route('apply.voucher') }}" method="POST">
                    @csrf
                    <input type="text" name="voucher_code" placeholder="Masukkan kode voucher">
                    <button type="submit">Apply Voucher</button>
                </form>

                <!-- resources/views/index_cart.blade.php -->

                <td>${{ number_format($item->amount, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('delete_cart', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Harga</th>
                <th colspan="2">${{ number_format($totalPrice, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
    @endif
</div>
@endsection