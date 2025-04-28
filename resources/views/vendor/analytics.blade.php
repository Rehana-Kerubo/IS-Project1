@extends('vendor.sidebar')

@section('content')

<h1 class="h3 mb-4">Sales Analytics</h1>

<!-- Total Sales Card -->
<div class="card mb-4 shadow-sm">
    <div class="card-body text-center">
        <h5 class="card-title">Total Sales</h5>
        <h2 class="text-success">Ksh 1,250.00</h2> <!-- Dummy Total -->
    </div>
</div>

<!-- Line Chart for Sales Over Time -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Sales Over Flea Market Days</h5>
        <canvas id="salesLineChart"></canvas>
    </div>
</div>

<!-- Bar Chart for Sales by Product -->
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Sales vs Products</h5>
        <canvas id="salesBarChart"></canvas>
    </div>
</div>

@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Dummy Data for testing
    const salesOverTimeLabels = ['2025-04-10', '2025-04-15', '2025-04-20', '2025-04-25'];
    const salesOverTimeData = [300, 450, 200, 300];

    const salesByProductLabels = ['Red T-shirt', 'Blue Jeans', 'Green Hat', 'Yellow Hoodie'];
    const salesByProductData = [500, 300, 250, 200];

    // Line Chart (Sales Over Time)
    const salesLineCtx = document.getElementById('salesLineChart').getContext('2d');
    const salesLineChart = new Chart(salesLineCtx, {
        type: 'line',
        data: {
            labels: salesOverTimeLabels,
            datasets: [{
                label: 'Sales ($)',
                data: salesOverTimeData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
    });

    // Bar Chart (Sales by Product)
    const salesBarCtx = document.getElementById('salesBarChart').getContext('2d');
    const salesBarChart = new Chart(salesBarCtx, {
        type: 'bar',
        data: {
            labels: salesByProductLabels,
            datasets: [{
                label: 'Sales ($)',
                data: salesByProductData,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
    });
</script>
@endsection
