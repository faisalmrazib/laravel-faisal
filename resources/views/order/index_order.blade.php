@extends('layouts.app')

@section('content')
<div class="container p-t-80 p-b-50">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Your Orders') }}</h4>
                </div>
                <div class="card-body">
                    @if ($orders->isEmpty())
                        <div class="alert alert-warning text-center">You have no orders.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($order->status == 'completed') bg-success 
                                                @elseif($order->status == 'pending') bg-warning 
                                                @else bg-danger @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('show_order', $order) }}" class="btn btn-sm btn-primary">
                                                <i class="zmdi zmdi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
