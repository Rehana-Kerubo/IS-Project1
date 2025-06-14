@extends('buyer.dashboard')

@section('title', 'Payment Successful')

@section('content')
<div class="invoice">
  <h2>🎉 Payment Successful!</h2>
  <p>Thank you for your purchase.</p>

  <div class="invoice-details">
    <p><strong>Product:</strong> {{ session('product_name') }}</p>
    <p><strong>Quantity:</strong> {{ session('quantity') }}</p>
    <p><strong>Total Paid:</strong> KSh {{ session('total') }}</p>
    <p><strong>Pickup Date:</strong> {{ session('pickup_date') }}</p>
  </div>

  <a href="{{ url('/buyer/landing') }}" class="btn">Back to Shopping</a>
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
