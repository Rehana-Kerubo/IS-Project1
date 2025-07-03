@extends('vendor.sidebar')

@section('content')
<div class="checkout-container">
  <h2 class="text-center mb-4">Book Stall for: {{ $event->title }}</h2>

  <div class="checkout-card">
    <form id="stallBookingForm" method="POST" action="#">
      @csrf
      <input type="hidden" name="vendor_id" value="{{ $vendor->vendor_id }}">
      <input type="hidden" name="announcement_id" value="{{ $event->announcement_id }}">
      <input type="hidden" name="amount_paid" value="1">
      <input type="hidden" name="type" value="stall">

      <label>Stall Booking Fee:</label>
      <p>KSh 1</p>

      <label for="phone">M-Pesa Phone Number:</label>
      <input type="text" name="phone" id="phone" placeholder="07XXXXXXXX" value="{{ old('phone', $buyer->phone_number ?? '') }}" required>

      <button type="button" class="pay-btn" id="payNowBtn">Pay</button>

      <div id="mpesaStatus" style="display:none; margin-top:20px; color:green; text-align:center;"></div>
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
  const stallForm = document.getElementById('stallBookingForm');
  const mpesaStatus = document.getElementById('mpesaStatus');

  payNowBtn?.addEventListener('click', function(e) {
    e.preventDefault();
    payNowBtn.disabled = true;
    mpesaStatus.style.display = 'block';
    mpesaStatus.innerText = 'Initiating M-Pesa STK Push...';

    const formData = new FormData(stallForm);
    fetch("{{ route('vendor.stall.stk.initiate') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        mpesaStatus.innerText = 'STK Push sent! Please complete payment on your phone.';
        // Optionally poll for payment confirmation or redirect after a delay
        setTimeout(() => {
          window.location.href = "{{ route('vendor.stall.payment.success') }}";
        }, 10000);
      } else {
        mpesaStatus.innerText = data.error || 'Failed to initiate payment.';
        payNowBtn.disabled = false;
      }
    })
    .catch(() => {
      mpesaStatus.innerText = 'Error initiating payment.';
      payNowBtn.disabled = false;
    });
  });
</script>
@endsection