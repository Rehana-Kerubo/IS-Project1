@extends('vendor.sidebar')

@section('content')
    <h2>Book Stall for: {{ $event->title }}</h2>

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

        <button type="submit" class="btn btn-success">Make Payment</button>
    </form>
@endsection
