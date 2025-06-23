@extends('buyer.dashboard')

@section('title', 'View Account')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h1 class="text-center mb-4" style="color: #000000;">Your Account Details</h1>
<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">

        <div class="text-center mb-3">
            <img src="{{ Auth::guard('buyer')->user()->profile_pic }}" 
                 alt="Profile Picture" 
                 class="rounded-circle border" 
                 width="80" height="80">
        </div>

        <div class="mb-3">
        <label>Full Name</label>
            <input type="text" class="form-control" 
                   value="{{ Auth::guard('buyer')->user()->full_name }}" readonly>
        </div>

        <div class="mb-3">
        <label>Email</label>
            <input type="text" class="form-control" 
                   value="{{ Auth::guard('buyer')->user()->email }}" readonly>
        </div>

        <div class="mb-3">
        <label>Phone Number</label>
            <input type="text" class="form-control" 
                   value="{{ Auth::guard('buyer')->user()->phone_number }}" readonly>
        </div>

        <a href="{{ url('/buyer/edit') }}" class="btn btn-primary w-100" style="background-color: #07BEB8; border-color: #07BEB8;">Edit Details</a>
    </div>
</div>

@endsection
