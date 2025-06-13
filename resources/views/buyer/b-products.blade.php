@extends('buyer.dashboard')

@section('title', 'Booked Products')

@section('content')
@php
    $bookedProducts = [
        (object)[
            'id' => 1,
            'name' => 'Red T-shirt',
            'image' => 'https://via.placeholder.com/300x200.png?text=Red+T-shirt',
            'quantity' => 2,
            'variation' => 'Size M',
            'deposit' => true,
        ],
        (object)[
            'id' => 2,
            'name' => 'Blue Jeans',
            'image' => 'https://via.placeholder.com/300x200.png?text=Blue+Jeans',
            'quantity' => 1,
            'variation' => 'Size 32',
            'deposit' => false,
        ],
    ];
@endphp

@if (count($bookedProducts))
        @foreach ($bookedProducts as $product)
            <div class="card mb-4 shadow-sm">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                            <p><strong>Variation:</strong> {{ $product->variation }}</p>
                            <p>
                                <strong>Status:</strong> 
                                <span class="badge badge-{{ $product->deposit ? 'success' : 'warning' }}">
                                    {{ $product->deposit ? 'Deposit Paid' : 'No Deposit Yet' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-muted">You haven’t booked any products yet 😢</p>
    @endif
@endsection