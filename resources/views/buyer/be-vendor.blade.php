@extends('buyer.dashboard')

@section('title', 'Become a Vendor')

@section('content')
    <h1 class="mb-4">Become a Vendor</h1>

    <div class="card p-4 shadow-sm" style="max-width: 600px;">
        <form action="" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" value="{{ Auth::user()->full_name }}" readonly>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
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

            <button type="submit" class="btn" style="background-color: #07BEB8; color: white; border-radius: 8px; padding: 10px 20px;">
                Apply
            </button>
        </form>
    </div>
@endsection
