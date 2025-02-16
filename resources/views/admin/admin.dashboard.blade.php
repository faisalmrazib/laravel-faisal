@extends('admin')

@section('content')
<div class="container-fluid">
    <h1>Dashboard Admin</h1>
    <div class="card">
        <div class="card-header">
            Grafik Pendapatan
        </div>
        <div class="card-body">
            <canvas id="revenueChart" width="100%" height="40"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   const ctx = document.getElementById('revenueChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Pendapatan',
            data: [12000000, 19000000, 3000000, 5000000, 2000000, 3000000],
            borderColor: '#4e73df',
            backgroundColor: 'rgba(78, 115, 223, 0.05)',
            tension: 0.4
        }]
    }
       
           
        }
    );
</script>
@endpush