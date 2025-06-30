@extends('vendor.sidebar')

@section('title', 'Payment Successful')

@section('content')
<div class="invoice">
  <h2>🎉 Payment Successful!</h2>
  <p>
    @if(session('type') === 'stall')
      Thank you for booking a stall, <strong>{{ $vendor -> shop_name }}!</strong>
    @else
      Thank you for your purchase.
    @endif
  </p>

  <div class="invoice-details">
    @if(session('type') === 'stall')
      <p><strong>Booking For:</strong> {{ $announcement -> title }} Flea Market</p>
      <p><strong>Amount Paid:</strong> KSh 1.00 </p>
      <p><strong>Booking Date:</strong> {{ \Carbon\Carbon::now()->toDateString() }}</p>
      <p>Please wait for the Admins to confirm your booking.You will be verified soon.</p>
      <p>Thank you for your Patience</p>
    @else
      <p><strong>Product:</strong> {{ session('product_name') }}</p>
      <p><strong>Quantity:</strong> {{ session('quantity') }}</p>
      <p><strong>Total Paid:</strong> KSh {{ session('total') }}</p>
      <p><strong>Pickup Date:</strong> {{ session('pickup_date') }}</p>
    @endif
  </div>

  <a href="{{ url('/vendor/dashboard') }}" class="btn">Back to Dashboard</a>
</div>

<style>
.invoice {
  max-width: 600px;
  margin: 60px auto;
  padding: 20px;
  background: #fefefe;
  text-align: center;
  border-radius: 20px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
.invoice-details {
  margin: 20px 0;
  text-align: left;
}
.btn {
  background-color: #07BEB8;
  color: #fff;
  padding: 12px 24px;
  border-radius: 10px;
  text-decoration: none;
}
</style>
@endsection
