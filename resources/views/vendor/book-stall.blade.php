@extends('vendor.sidebar')

@section('content')
    <h2 class="text-center mb-4" style="color: #000000;">Book Stall for: {{ $event->title }}</h2>
    <div class="d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <form action="{{ route('stall.store') }}" method="POST">
        @csrf
        <div>
            <label class="block">Shop Name</label>
            <input type="text" name="shop_name" value="{{ Auth::guard('buyer')->user()->vendor->shop_name }}" class="form-control" readonly>
        </div>
        <div>
            <label class="block">Market Title</label>
            <input type="text" name="title" value="{{ $event->title }}" class="form-control"readonly>
        </div>

        <div class="mb-3">
            <label>Amount Due:</label>
            <input type="text" name="amount_paid" class="form-control" value="Ksh. 600.00" readonly>
        </div>

        <button type="submit" class="btn btn-success" style="background-color:rgb(7, 117, 82); border-color:rgb(7, 117, 82); text-align: center; width: 100%;">
            Make Payment
        </button>
    </form>
    </div>
    </div>
@endsection
