@extends('admin.sidebar')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold">Manage Shop Categories</h3>

    <div class="d-flex flex-wrap gap-4 justify-content-between align-items-start">

    <!-- Pie Chart Card -->
    <div style="flex: 1 1 300px; max-width: 400px;">
        <div class="mb-2 fw-semibold">Vendor Distribution by Category</div>
        <div class="card-body d-flex justify-content-center">
            <canvas id="categoryChart" style="max-width: 300px; max-height: 300px;"></canvas>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card mb-4 shadow-sm" style="flex: 1 1 300px; max-width: 400px;">
        <div class="card-header text-white fw-semibold" style="background-color: rgba(31, 136, 193, 0.92)">Add New Category</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Fashion, Art, Food" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Add Category</button>
            </form>
        </div>
    </div>

</div>


    <!-- Category Table -->
    <div class="card mb-4 mt-4 shadow-sm">
        <div class="card-header text-white fw-semibold" style="background-color: rgba(31, 136, 193, 0.92)">All Categories</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('categoryChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Vendors',
                data: {!! json_encode($chartData) !!},
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#fd7e14'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endsection
