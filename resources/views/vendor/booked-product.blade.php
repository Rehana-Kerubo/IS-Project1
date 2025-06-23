@extends('vendor.sidebar')

@section('content')

<div class="container mt-4">
    <h3 class="mb-4" style="color: #000000;">Product Bookings: {{ $product->name }}</h3>


    <div class="card shadow">
        <div class="card-body table-responsive">
        <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Buyer Name</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Commitment Fee</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booked)
                                <tr>
                                    <td>{{ $booked->buyer->full_name }}</td>
                                    <td>{{ $booked->quantity }}</td>
                                    <td>
                                        <span class="badge {{ $booked->status === 'booked' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($booked->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($booked->commitment_fee_paid)
                                            <span class="text-success fw-bold">Paid</span>
                                        @else
                                                <form action="{{ route('vendor.markCommitmentPaid', $booked->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-success">Mark as Paid</button>
                                            </form>
                                        @endif
                                    </td>

                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
        </div>
    </div>
</div>
@endsection
