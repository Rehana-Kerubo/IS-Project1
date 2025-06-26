@extends('buyer.dashboard')

@section('title', 'Edit Profile')

@section('content')
@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
<div>
<h1 class="text-center mb-4" style="color: #000000;">Edit Your Profile</h1>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <!-- Edit Form -->
        <form action="{{ route('buyer.update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            

            <!-- Full Name -->
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" value="{{ Auth::guard('buyer')->user()->full_name }}">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="{{ Auth::guard('buyer')->user()->email }}" readonly>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Enter your phone number" value="{{ Auth::guard('buyer')->user()->phone_number }}">
            </div>

            <button type="submit" class="edit-btn" style="width: 100%;">Save Changes</button>
        </form>
        </div>
    </div>
</div>

@endsection
