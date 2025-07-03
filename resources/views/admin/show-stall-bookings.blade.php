@extends('admin.sidebar')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Stall Bookings</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div style="display: flex; flex-direction: column; gap: 10px;">
        <h2 class="mb-0" style="color:rgb(3, 110, 198);">{{ $announcement->title }} Flea Market</h2>
        <p class="card-text text-muted">{{ $announcement->start_date }} to {{ $announcement->end_date }}</p>
        </div>
        @if($stallPayments->count() > 0)
            <form action="{{ route('admin.unverifyExpiredVendors') }}" method="POST">
                @csrf
                <button class="btn btn-warning">Unverify All</button>
            </form>
            @else
            <p class="text-muted mb-0">No verifications to revoke for this event.</p>
         @endif
        </div>

    <div class="card shadow" style="width: 900px; margin: 0 auto;">
        <div class="card-body table-responsive">
        <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Shop Name</th>
                                <th>Amount Paid</th>
                                <th>Paid On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stallPayments as $payment)
                                <tr>
                                    <td>{{ $payment->vendor->shop_name }}</td>
                                    <td>KES {{ number_format($payment->amount_paid, 2) }}</td>
                                    <td>{{ $payment->created_at->format('d M Y') }}</td>
                                    <td>{{ $payment->vendor->status }}</td>
                                    <td>
                                        <form action="{{ route('admin.verifyVendor', $payment->vendor) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="announcement_end_date" value="{{ $payment->announcement->end_date }}">
                                            <input type="hidden" name="announcement_id" value="{{ $payment->announcement->announcement_id }}">
                                            <button type="submit" class="btn btn-success">Verify</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
        </div>
    </div>
</div>
@endsection
