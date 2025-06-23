@extends('vendor.sidebar')

@section('content')
<style>
        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
    </style>
<h1 class="text-center mb-4" style="color: #000000;">Product Bookings</h1>

<div class="row">
    @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
            @if ($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-img">
                @endif
                <div class="card-body text-center">
                    <h5 class="card-title" style="color: #000000;">{{ $product->name }}</h5>
                    <p class="card-text mb-4">
                        {{ $product->booking_count }} Booking{{ $product->booking_count !== 1 ? 's' : '' }}
                    </p>

                    <a href="{{ route('vendor.booked-product.show', $product->product_id) }}" class="btn btn-primary mt-2" style="background-color:rgb(7, 117, 82); border-color:rgb(7, 117, 82);">
                        View Bookings
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@if ($products->isEmpty())
    <p>No products booked yet.</p>
@endif

@endsection
