@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Vouchers</h1>
    <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary mb-3">Add New Voucher</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Discount</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->id }}</td>
                <td>{{ $voucher->code }}</td>
                <td>{{ $voucher->discount }}</td>
                <td>{{ $voucher->expiry_date }}</td>
                <td>
                    <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection