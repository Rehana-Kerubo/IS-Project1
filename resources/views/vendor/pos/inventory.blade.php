@extends('vendor.pos.sidebar')

@section('content')
<h3 class="mb-4 fw-bold">Manage Inventory</h3>

{{-- Success message --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- Add Inventory Form --}}
<div class="d-flex justify-content-center">
    <div class="form-container" style="width: 100%; max-width: 500px;">
       <form action="{{ route('vendor.pos.inventory.store') }}" method="POST">
            @csrf

            {{-- Product Dropdown --}}
            <div class="mb-3">
                <input type="hidden" name="test_form" value="working">

                <label for="product_id">Product</label>
                <select name="product_id" id="product_id" class="form-control" required onchange="fillProductDetails(this)">
                    <option value="" disabled selected>Select a product</option>
                    @foreach($products as $product)
                        <option 
                            value="{{ $product->product_id }}"
                            data-price="{{ $product->price }}"
                            data-stock="{{ $product->available_stock }}"
                            >
                            {{ $product->name }}
                        </option>
                     @endforeach
                </select>
            </div>

            {{-- Auto-filled Selling Price --}}
            <div class="mb-3">
                <label for="selling_price">Selling Price (KSh)</label>
                <input type="text" name="selling_price" id="selling_price" class="form-control" readonly>
            </div>

            {{-- Auto-filled Stock Quantity --}}
            <div class="mb-3">
                <label for="stock_quantity">Stock Quantity</label>
                <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" readonly>
            </div>

            {{-- Buying Price (manual) --}}
            <div class="mb-3">
                <label for="buying_price">Buying Price (KSh)</label>
                <input type="number" name="buying_price" class="form-control" required>
            </div>

            {{-- Submit --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Add to Inventory</button>
            </div>
        </form>

    </div>
</div>


{{-- Existing Inventory --}}
@if($inventory->count())
    <h5 class="mt-4">Current Inventory</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Stock Quantity</th>
                <th>Buying Price (KSh)</th>
                <th>Selling Price (KSh)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventory as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Unknown Product' }}</td>
                    <td>{{ $item->stock_quantity }}</td>
                    <td>{{ number_format($item->buying_price, 2) }}</td>
                    <td>{{ number_format($item->selling_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-muted mt-4">No inventory added yet.</p>
@endif


<script>
    function fillProductDetails(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        const stock = selectedOption.getAttribute('data-stock');

        document.getElementById('selling_price').value = price;
        document.getElementById('stock_quantity').value = stock;
    }
</script>

@endsection
