@extends('buyer.dashboard')

@section('title', 'Become a Vendor')

@section('content')
<h1 class="text-center mb-4" style="color: #000000;">Become a Vendor</h1>

    <div class="d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        <form action="{{ route('buyer.be-vendor') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" value="{{ Auth::guard('buyer')->user()->full_name }}" readonly>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" value="{{ Auth::guard('buyer')->user()->email }}" readonly>
            </div>

            <div class="form-group">
                <label for="shop_name">Shop Name</label>
                <input type="text" class="form-control" name="shop_name" required placeholder="e.g. Dreamy Styles">
            </div>

            <div class="form-group">
                <label for="shop_category">Shop Category</label>
                <select name="shop_category" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Makeup & Beauty">Makeup & Beauty</option>
                    <option value="Footwear">Footwear</option>
                    <option value="Crafts">Crafts</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100" style="background-color: #07BEB8; border-color: #07BEB8;"">
                Apply
            </button>
        </form>
        </div>
    </div>
@endsection
