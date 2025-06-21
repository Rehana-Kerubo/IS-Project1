@extends('vendor.pos.sidebar')

@section('content')
<div class="container">
    <h2 class="mb-4">Point of Sale (POS)</h2>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Search Bar --}}
    <form method="GET" class="mb-4">
        <input type="text" name="search" class="form-control" placeholder="Search product...">
    </form>

    {{-- Inventory Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>In Stock</th>
                <th>Price (KSh)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->stock_quantity }}</td>
                <td>{{ number_format($item->selling_price ?? $item->product->price, 2) }}</td> <!-- ✅ fix -->

                <td>
                    <!-- Button to trigger modal -->
                    <button class="btn btn-sm btn-primary" 
                        onclick="openForm({{ $item->id }}, '{{ $item->product->name }}', {{ $item->selling_price ?? $item->product->price }}, {{ $item->stock_quantity }})">
                        Make Sale
                    </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Sale Form Modal --}}
<div id="saleModal" class="modal" tabindex="-1" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <form method="POST" action="{{ route('vendor.pos.sell') }}">
                @csrf
                <input type="hidden" name="inventory_id" id="inventory_id">
                <h5 id="productName"></h5>

                <label>Quantity</label>
                <input type="number" name="quantity_sold" id="quantity" min="1" max="1000" class="form-control" required>

                <p class="mt-2">Total: KSh <span id="totalPrice">0.00</span></p>

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2" onclick="closeForm()">Cancel</button>
                    <button type="submit" class="btn btn-success">Confirm Sale</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
    let price = 0;

    function openForm(id, name, unitPrice, stockQty) {
        document.getElementById('inventory_id').value = id;
        document.getElementById('productName').innerText = name + " (" + stockQty + " in stock)";
        document.getElementById('quantity').value = 1;
        price = unitPrice;
        updateTotal();

        document.getElementById('saleModal').style.display = 'block';
    }

    function closeForm() {
        document.getElementById('saleModal').style.display = 'none';
    }

    function updateTotal() {
        const quantity = parseInt(document.getElementById('quantity').value) || 0;
        document.getElementById('totalPrice').innerText = (quantity * price).toFixed(2);
    }

    document.getElementById('quantity').addEventListener('input', updateTotal);
</script>
@endsection
