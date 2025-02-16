@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Voucher Baru</h4>
        </div>
        <div class="card-body">
<!-- resources/views/admin/vouchers/create.blade.php -->
<form action="{{ route('admin_vouchers_store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="code">Kode Voucher</label>
        <input type="text" name="code" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="discount_amount">Jumlah Diskon</label>
        <input type="number" name="discount_amount" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="discount_type">Tipe Diskon</label>
        <select name="discount_type" class="form-control" required>
            <option value="percentage">Persentase</option>
            <option value="fixed">Nominal</option>
        </select>
    </div>
    <div class="form-group">
        <label for="max_uses">Batas Penggunaan</label>
        <input type="number" name="max_uses" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="valid_from">Tanggal Mulai Berlaku</label>
        <input type="datetime-local" name="valid_from" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="valid_until">Tanggal Berakhir</label>
        <input type="datetime-local" name="valid_until" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="min_purchase">Minimal Pembelian</label>
        <input type="number" name="min_purchase" class="form-control" value="0">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush 
