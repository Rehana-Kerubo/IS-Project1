@extends('vendor.sidebar')

@section('content')

<h1 class="text-center mb-4" style="color: #000000;">Shop Products</h1>

<!-- Add Product Button -->
<a href="/vendor/add-product" class="btn btn-primary mb-4" style="background-color:rgb(8, 133, 81); border-color:rgb(8, 133, 81);"> <i class="lni lni-plus"></i> Add Product</a>

<!-- Products Grid -->
<div class="row">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @forelse ($products as $product)
    <style>
        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
    </style>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                @if ($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-img">
                @endif
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title" style="color: #000000;">{{ $product->name }}</h4>
                    <p class="card-text mb-4">
                        <strong>Price:</strong> Ksh {{ number_format($product->price, 2) }} <br>
                        <strong>Stock:</strong> {{ $product->available_stock }} units
                    </p>
                    <!-- Edit Button -->
                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('vendor.products.edit', $product->product_id) }}" class="btn btn-sm btn-warning flex-grow-1">Edit</a>

                        <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100" style="background-color:rgb(178, 6, 6); border-color:rgb(178, 6, 6);">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No products uploaded yet.</p>
    @endforelse
</div>

@endsection
