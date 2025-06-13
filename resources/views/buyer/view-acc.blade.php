@extends('buyer.dashboard')

@section('title', 'View Account')

@section('content')
    <h1 class="mb-4">Your Account Details</h1>
    <div class="account-card">
        <img src="path/to/profile-pic.jpg" alt="Profile Picture" class="profile-pic">
        <h4>Name: Rehana</h4>
        <p>Email: Rehana</p>
        <p>Status: Active</p>
        <button class="edit-btn">Edit Details</button>
    </div>
@endsection
