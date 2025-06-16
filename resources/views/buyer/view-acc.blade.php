@extends('buyer.dashboard')

@section('title', 'View Account')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <h1 class="mb-4">Your Account Details</h1>
    <div class="account-card">
        <img src="path/to/profile-pic.jpg" alt="Profile Picture" class="profile-pic">
        <input type="text" class="form-control" value="{{ Auth::guard('buyer')->user()->full_name }}" readonly>
        <input type="text" class="form-control" value="{{ Auth::guard('buyer')->user()->email }}" readonly>
        <input type="text" class="form-control" value="{{ Auth::guard('buyer')->user()->phone_number }}" readonly>
        <button class="edit-btn"><a href="{{ url('/buyer/edit') }}">Edit Details</a></button>
    </div>
@endsection
