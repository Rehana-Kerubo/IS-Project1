@extends('admin.sidebar')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">
        <div class="text-center mb-4">
            <i class="lni lni-user" style="font-size: 60px; color: #07BEB8;"></i>
            <h4 class="mt-2">Admin Profile</h4>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" value="{{ Auth::guard('admin')->user()->full_name }}" class="form-control" readonly>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" value="{{ Auth::guard('admin')->user()->email }}" class="form-control" readonly>
            </div>
            <div class="text-center">
            <a href="{{ route('admin.password.update') }}" class="btn btn-primary px-4" style="background-color: #343a40; border-color: #343a40;">Change Password</a>
            </div>

        </form>
    </div>
</div>
@endsection
