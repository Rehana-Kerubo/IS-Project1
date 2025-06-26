@extends('admin.sidebar')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Vendor Analytics Dashboard</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5 class="text-muted">Total Revenue</h5>
                <h3 class="text-success">KSh {{ number_format($totalRevenue, 2) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5 class="text-muted">Total Vendors</h5>
                <h3 class="text-primary">{{ $vendorCount }}</h3>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <strong>Vendor List</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            
            <th>Vendor Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Shop Name</th>
            <th>Category</th>
            <th>Status</th>
            <th>Products</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vendors as $vendor)
            <tr>
                
                <td>{{ $vendor->buyer_name }}</td>
                <td>{{ $vendor->email }}</td>
                <td>{{ $vendor->phone_number }}</td>
                <td>{{ $vendor->shop_name }}</td>
                <td>{{ $vendor->shop_category }}</td>
                <td>
                    <span class="badge {{ $vendor->status === 'verified' ? 'bg-success' : 'bg-warning' }}">
                        {{ ucfirst($vendor->status) }}
                    </span>
                </td>
                <td>{{ $vendor->product_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


        </div>
    </div>
</div>
@endsection
