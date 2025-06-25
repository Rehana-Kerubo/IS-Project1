@extends('vendor.sidebar')

@section('title', 'Checkout')

@section('content')
<div class="checkout-container">
  <h2>Checkout - {{ $product->name }}</h2>

  <div class="checkout-card">
    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="checkout-image">

   


    <form id="checkoutForm" method="POST" action="{{ route('vendor.payment-loader') }}">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->product_id }}">
      

      <label>Price (per item):</label>
      <p>KSh <span id="price">{{ $product->price }}</span></p>

      <label for="quantity">Quantity:</label>
      <input type="number" name="quantity" id="quantity" value="1" min="1">

      <label>Total:</label>
      <p>KSh <span id="total">{{ $product->price }}</span></p>

      <label for="phone">M-Pesa Phone Number:</label>
<input type="text" name="phone" placeholder="07XXXXXXXX" value="{{ old('phone', $buyer->phone_number ?? '') }}" required>

      <button type="button" class="pay-btn" id="payNowBtn">Pay Now</button>

      <!-- FAKE MPESA PROMPT MODAL -->
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
.checkout-image {
  width: 100%;
  border-radius: 10px;
  margin-bottom: 20px;
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
.loader {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #07BEB8;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  margin: 0 auto;
  animation: spin 1s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<script>
  const payNowBtn = document.getElementById('payNowBtn');
  const mpesaModal = document.getElementById('mpesaPrompt');
  const confirmPinBtn = document.getElementById('confirmPinBtn');
  const checkoutForm = document.getElementById('checkoutForm');
  const quantityInput = document.getElementById('quantity');
  const price = parseFloat(document.getElementById('price').innerText);
  const totalDisplay = document.getElementById('total');

  quantityInput?.addEventListener('input', () => {
    const qty = parseInt(quantityInput.value) || 1;
    const total = price * qty ;
    totalDisplay.innerText = Math.round(total);
  });

  payNowBtn?.addEventListener('click', () => {
    mpesaModal.style.display = 'flex';
  });

  confirmPinBtn?.addEventListener('click', () => {
    const pin = document.getElementById('fakePin').value;
   
    if (pin.length < 4) {
      alert("PIN must be at least 4 digits!");
      return;
    }

    // Submit the form to simulate checkout
    console.log('Form submitting to:', checkoutForm.action);
    checkoutForm?.submit();
  });
</script>

@endsection
