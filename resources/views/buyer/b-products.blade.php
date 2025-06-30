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
    .card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
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
                          
                        <div class="mt-auto text-right">
                            <form class="delete-booking-form" data-id="{{ $booking->id }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger btn-sm">
        Delete Booking ❌
    </button>
</form>

                        </div>

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
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-booking-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Stop normal form submit

                const bookingId = form.getAttribute('data-id');
                const actionUrl = `/buyer/bookings/${bookingId}`;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to undo this booking deletion and no refunds will be administered!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        popup: 'rounded-xl',
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create and submit the form manually
                        const tempForm = document.createElement('form');
                        tempForm.method = 'POST';
                        tempForm.action = actionUrl;

                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = '{{ csrf_token() }}';

                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';

                        tempForm.appendChild(csrfInput);
                        tempForm.appendChild(methodInput);
                        document.body.appendChild(tempForm);
                        tempForm.submit();
                    }
                });
            });
        });
    });
</script>

