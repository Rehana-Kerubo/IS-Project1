@extends('vendor.sidebar')

@section('content')

<h1 class="h3 mb-4">My Products</h1>

<!-- Add Product Button -->
<a href="/vendor/add-product" class="btn btn-primary mb-4">Add Product</a>

<!-- Products Grid -->
<div class="row">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @forelse ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                @if ($product->image)
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text mb-4">
                        <strong>Price:</strong> Ksh {{ number_format($product->price, 2) }} <br>
                        <strong>Stock:</strong> {{ $product->available_stock }} units
                    </p>
                    <!-- Edit Button -->
                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-sm btn-warning flex-grow-1">Edit</a>

                        <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No products found.</p>
    @endforelse
</div>

@endsection
