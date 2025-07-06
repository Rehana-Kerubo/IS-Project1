@extends('vendor.sidebar')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h1 class="text-center mb-4" style="color: #000000;">Shop Dashboard</h1>
<div class="d-flex justify-content-center align-items-center">
<div class="card shadow p-4" style="width: 100%; max-width: 400px;">

<form action="{{ route('vendor.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="block" style="font-weight: 600;">Shop Name</label>
        <input type="text" class="form-control" name="shop_name" value="{{ Auth::guard('buyer')->user()->vendor->shop_name }}">
    </div>

    <div class="mb-3">
        <label class="block" style="font-weight: 600;">Shop Category</label><br>
        <select name="category_id" class="form-control" required>
    <option value="">Choose a Category</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            {{ Auth::guard('buyer')->user()->vendor->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>

    </div>
    <div class="mb-3">
        <label class="block" style="font-weight: 600;">Status</label><br>
        <span class="badge {{ Auth::guard('buyer')->user()->vendor->status === 'verified' ? 'bg-success' : 'bg-warning' }}">
            {{ ucfirst(Auth::guard('buyer')->user()->vendor->status) }}
        </span>
    </div>
    @php
        use App\Models\StallPayment;
        use App\Models\Announcement;

        $vendor = Auth::guard('buyer')->user()->vendor;
        $stallNumber = 'Not assigned';
        $eventName = null;

        if ($vendor) {
            $payment = StallPayment::where('vendor_id', $vendor->vendor_id)
                ->whereNotNull('stall_number')
                ->latest('updated_at')
                ->first();

            if ($payment) {
                $stallNumber = $payment->stall_number;
                $eventName = $payment->announcement?->title;
            }
        }
    @endphp
    @if (Auth::guard('buyer')->user()->vendor->status === 'verified')
    <div class="mb-4">
        <label class="fw-semibold d-block mb-1">Shop Number</label>
        <span class="badge {{ $stallNumber !== 'Not assigned' ? 'bg-success' : 'bg-warning' }}">
            {{ $stallNumber }}
        </span>

        @if ($eventName)
            <p class="mt-2 mb-0 text-muted" style="font-weight: 500;">
                <small>For event: {{ $eventName }}</small>
            </p>
        @endif
    </div>
    @endif




    <button type="submit" class="btn btn-primary px-4" style="background-color: #07BEB8; border-color: #07BEB8; width: 100%;">Update</button>
</form>
    </div>
</div>

@endsection
