@extends('vendor.pos.sidebar')

@section('content')
<h3>Manage Inventory</h3>

{{-- Success message --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Add Inventory Form --}}
<form method="POST" action="{{ route('vendor.pos.inventory.store') }}" class="mb-4">
    @csrf

    <div class="mb-3">
        <label>Product</label>
        <select name="product_id" class="form-control" required>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->price }} KSh)</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Stock Quantity</label>
        <input type="number" name="stock_quantity" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Buying Price (KSh)</label>
        <input type="number" step="0.01" name="buying_price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Selling Price (KSh)</label>
        <input type="number" step="0.01" name="selling_price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Low Stock Threshold</label>
        <input type="number" name="low_stock_threshold" class="form-control" value="5">
    </div>

    <button type="submit" class="btn btn-primary">Add Inventory</button>
</form>

{{-- Existing Inventory --}}
<h4>Current Inventory</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Stock</th>
            <th>Selling Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventory as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->stock_quantity }}</td>
                <td>{{ number_format($item->selling_price, 2) }} KSh</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
