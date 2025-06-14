@extends('buyer.dashboard')

@section('title', 'Edit Profile')

@section('content')
<div>
    <h1 class="mb-4">Edit Your Profile</h1>
    <div class="account-card">
        <!-- Edit Form -->
        <form action="{{ route('buyer.update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Picture Edit -->
            <div class="form-group text-center">
                <label for="profile_pic">
                    <img src="{{ Auth::user()->profile_pic ? asset('storage/' . Auth::user()->profile_pic) : 'https://via.placeholder.com/100' }}" 
                         alt="Profile Picture" class="profile-pic mb-2">
                </label>
                <input type="file" name="profile_pic" id="profile_pic" class="form-control-file">
            </div>

            <!-- Full Name -->
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" value="{{ Auth::user()->full_name }}">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email (readonly)</label>
                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone_number" class="form-control" value="{{ Auth::user()->phone_number }}">
            </div>

            <button type="submit" class="edit-btn">Save Changes</button>
        </form>
    </div>
</div>

@endsection
