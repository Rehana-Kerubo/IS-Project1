@extends('buyer.dashboard')

@section('title', 'Booked Products')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4" style="color: #000000;">Booked Products</h1>
    
<style>
    .product-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

<!-- @if ($bookedProducts->count()) -->
    @forelse ($bookedProducts as $booking)
        <div class="card mb-4 shadow-sm">
            <div class="row no-gutters">
                <div class="col-md-4">
                @if ($booking->product->image_url)
                    <img src="{{ asset('storage/' . $booking->product->image_url) }}" alt="{{ $booking->product->name }}" class="product-img">
                @endif                
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">{{ $booking->product->name }}</h4>
                        <p><strong>Quantity:</strong> {{ $booking->quantity }}</p>
                        <!-- <p><strong>Variation:</strong> {{ $booking->product->variation ?? 'N/A' }}</p> -->
                        <p>
                            <strong>Status:</strong> 
                            <span class="badge badge-{{ $booking->commitment_fee_paid ? 'success' : 'warning' }}">
                                {{ $booking->commitment_fee_paid ? 'Deposit Paid' : 'No Deposit Yet' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @empty
    
    <p class="text-muted">You haven’t booked any products yet 😢</p> 
    @endforelse
    </div>

<!-- @endif -->

@endsection