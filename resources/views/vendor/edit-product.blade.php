@extends('vendor.sidebar')

@section('title', 'Edit Product')

@section('content')
    <div class="container mt-4">
        <h2>Edit Product</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vendor.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" name="price" step="0.01" min="0" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="available_stock">Available Stock</label>
                <input type="number" name="available_stock" min="1" class="form-control" value="{{ $product->available_stock }}" required>
            </div>

            <div class="form-group mb-4">
                <label for="image">Update Product Image</label>
                <input type="file" name="image" class="form-control-file">
                @if ($product->image_url)
                    <p class="mt-2"><strong>Current Image:</strong></p>
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" style="max-width: 200px;">
                @endif
            </div>

            <button type="submit" class="btn btn-success">Update Product</button>
            <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary ml-2">Back</a>
        </form>
    </div>
@endsection
