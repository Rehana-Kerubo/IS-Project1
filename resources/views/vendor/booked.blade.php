@extends('vendor.sidebar')

@section('content')

<h1 class="h3 mb-4">Product Bookings</h1>

<!-- Dummy Products with Bookings -->
@php
    $products = [
        (object)[
            'id' => 1,
            'name' => 'Red T-shirt',
            'image' => 'https://via.placeholder.com/300x200.png?text=Red+T-shirt',
            'bookings' => [
                (object)['buyer' => 'Alice','quantity'=>20, 'variation' => 'Size M', 'deposit' => false],
                (object)['buyer' => 'Charlie', 'quantity'=>15,'variation' => 'Size L', 'deposit' => true],
            ],
        ],
        (object)[
            'id' => 2,
            'name' => 'Blue Jeans',
            'image' => 'https://via.placeholder.com/300x200.png?text=Blue+Jeans',
            'bookings' => [
                (object)['buyer' => 'Bob', 'quantity'=>5,'variation' => 'Size 32', 'deposit' => true],
            ],
        ],
    ];
@endphp

<div class="row">
    @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if ($product->image)
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>

                     <!-- Total Bookings Badge -->
                    <span class="badge bg-primary mb-3">
                        {{ count($product->bookings) }} Booking{{ count($product->bookings) !== 1 ? 's' : '' }}
                    </span>

                    <br>
                    <button class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#product-{{ $product->id }}">
                        View Bookings
                    </button>
                </div>
            </div>
        </div>

        <div class="collapse my-3" id="product-{{ $product->id }}">
            <div class="card card-body">
                @if (count($product->bookings) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Buyer</th>
                                    <th>Variation</th>
                                    <th>Quantity</th>
                                    <th>Deposit Received?</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->buyer }}</td>
                                        <td>{{ $booking->variation }}</td>
                                        <td>{{ $booking->quantity }}</td>
                                        <td>{{ $booking->deposit ? 'Yes' : 'No' }}</td>
                                        <td>
                                            @if (!$booking->deposit)
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Verify</button>
                                                </form>
                                            @else
                                                <span class="badge bg-success">Verified</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No bookings for this product yet.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>

@endsection
