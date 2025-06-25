@extends('buyer.dashboard')

@section('title', 'Booked Products')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4" style="color: #000000;">Booked Products</h1>
    


<!-- @if ($bookedProducts->count()) -->
    @forelse ($bookedProducts as $booking)
        <div class="card mb-4 shadow-sm">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ $booking->product->image }}" alt="{{ $booking->product->name }}" class="img-fluid rounded-start">
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