@extends('buyer.dashboard')


@section('title', 'Processing Payment')

@section('content')
<div class="loader-screen">
  <div class="loader-circle"></div>
  <p>Processing Payment... Please wait</p>
</div>

<style>
.loader-screen {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 80vh;
  text-align: center;
}
.loader-circle {
  border: 5px solid #C4FFF9;
  border-top: 5px solid #07BEB8;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 1s linear infinite;
  margin-bottom: 20px;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<script>
  setTimeout(() => {
    window.location.href = "{{ route('buyer.payment.success') }}";
  }, 3000);
</script>
@endsection
