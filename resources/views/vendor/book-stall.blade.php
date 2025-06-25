@extends('vendor.sidebar')

@section('content')
<div class="checkout-container">
  <h2 class="text-center mb-4">Book Stall for: {{ $event->title }}</h2>

  <div class="checkout-card">
    <form id="stallBookingForm" method="POST" action="{{ route('vendor.stall.payment.loader') }}">
      @csrf
      <input type="hidden" name="vendor_id" value="{{ $vendor->vendor_id }}">
      <input type="hidden" name="announcement_id" value="{{ $event->announcement_id }}">
      <input type="hidden" name="amount_paid" value="600">
      <input type="hidden" name="type" value="stall">

      <label>Stall Booking Fee:</label>
      <p>KSh 600</p>

      <label for="phone">M-Pesa Phone Number:</label>
      <input type="text" name="phone" placeholder="07XXXXXXXX" required>

      <button type="button" class="pay-btn" id="payNowBtn">Pay</button>

      <!-- M-Pesa Modal -->
      <div id="mpesaPrompt" class="mpesa-modal">
        <div class="mpesa-content">
          <h4>M-Pesa STK Push</h4>
          <p>Enter M-Pesa PIN</p>
          <input type="password" id="fakePin" placeholder="****">
          <button type="button" class="confirm-pin-btn" id="confirmPinBtn">Confirm</button>
        </div>
      </div>
    </form>
  </div>
</div>

<style>
.checkout-container {
  max-width: 600px;
  margin: 60px auto;
  padding: 20px;
}
.checkout-card {
  background: #fff;
  padding: 20px;
  border-radius: 20px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}
input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 10px;
  border: 1px solid #ddd;
}
.pay-btn {
  width: 100%;
  background-color: #07BEB8;
  color: #fff;
  padding: 12px;
  border: none;
  border-radius: 10px;
  font-weight: bold;
  cursor: pointer;
}
.mpesa-modal {
  display: none;
  position: fixed;
  z-index: 999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  justify-content: center;
  align-items: center;
}
.mpesa-content {
  background: #fff;
  padding: 30px;
  border-radius: 15px;
  text-align: center;
  max-width: 300px;
}
.confirm-pin-btn {
  background-color: #07BEB8;
  color: white;
  padding: 10px 20px;
  border-radius: 10px;
  margin-top: 10px;
  border: none;
  cursor: pointer;
}
</style>

<script>
  const payNowBtn = document.getElementById('payNowBtn');
  const mpesaModal = document.getElementById('mpesaPrompt');
  const confirmPinBtn = document.getElementById('confirmPinBtn');
  const stallForm = document.getElementById('stallBookingForm');

  payNowBtn?.addEventListener('click', () => {
    mpesaModal.style.display = 'flex';
  });

  confirmPinBtn?.addEventListener('click', () => {
    const pin = document.getElementById('fakePin').value;
    if (pin.length < 4) {
      alert("PIN must be at least 4 digits!");
      return;
    }
    stallForm?.submit();
  });
</script>
@endsection
