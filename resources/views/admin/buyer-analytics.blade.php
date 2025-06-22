@extends('admin.sidebar')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Buyer Analytics Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5 class="text-muted">Total Buyers</h5>
                <h3 class="text-primary">{{ $buyerCount }}</h3>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <strong>List of Buyers</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buyers as $buyer)
                        <tr>
                            <td>{{ $buyer->full_name }}</td>
                            <td>{{ $buyer->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
