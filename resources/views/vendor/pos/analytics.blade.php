@extends('vendor.pos.sidebar')

@section('content')
<h2 class="mb-4 fw-bold">📊 POS Analytics</h2>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white" style="background-color: #07BEB8;">
            <div class="card-body">
                <h5>Total Sales</h5>
                <h3>KSh {{ number_format($totalSales, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white" style="background-color: #3DCCC7;">
            <div class="card-body">
                <h5>Total Profit</h5>
                <h3>KSh {{ number_format($totalProfit, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white" style="background-color: #68D8D6;">
            <div class="card-body">
                <h5>Most Sold Product</h5>
                <h3>{{ $mostSoldProduct ?? 'N/A' }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="row">
    <div class="col-md-6">
        <canvas id="barChart"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="pieChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($labels) !!};
    const data = {!! json_encode($data) !!};

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Units Sold',
                data: data,
                backgroundColor: '#9CEAEF'
            }]
        },
    });

    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales Breakdown',
                data: data,
                backgroundColor: ['#07BEB8', '#3DCCC7', '#68D8D6', '#9CEAEF', '#C4FFF9']
            }]
        },
    });
</script>
@endsection
