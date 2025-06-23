@extends('vendor.sidebar')

@section('title', 'Add New Product')

@section('content')
    <div class="container mt-4">
        <h2>Add New Product</h2>

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

        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="name" style="font-weight: 600;">Product Name</label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. Handmade Earrings" autofocus>
            </div>

            <div class="form-group mb-3">
                <label for="description" style="font-weight: 600;">Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Product details..."></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="price" style="font-weight: 600;">Price</label>
                <input type="number" name="price" step="0.01" min="0" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image" style="font-weight: 600;">Product Image</label><br>
                <input type="file" name="image" class="form-control-file" required>
            </div><br>

            <div class="form-group mb-4">
                <label for="available_stock" style="font-weight: 600;">Available Stock</label>
                <input type="number" name="available_stock" min="1" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary px-4" style="background-color:rgb(7, 117, 82); border-color:rgb(7, 117, 82);">Add Product</button>
            <a href="{{ url('/vendor/products') }}" class="btn btn-secondary px-4" style="background-color:rgb(102, 123, 122); border-color:rgb(102, 123, 122);">Back</a>
        </form>
    </div>
@endsection
