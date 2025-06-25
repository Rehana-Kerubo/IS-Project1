@extends('admin.sidebar')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="w-100" style="max-width: 600px;">
        <h2 class="mt-2 text-center">Change Password</h2>

        <form method="POST" action="{{ route('admin.password.update') }}" class="card shadow p-4" style="border-radius: 15px;">
            @csrf

            {{-- Success Flash Message --}}
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following:</strong>
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3 position-relative">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control pe-5" required>
                <span class="position-absolute top-50" 
                    style="right: 10px; cursor: pointer;" 
                    onclick="togglePassword('current_password', this)">
                    Show
                </span>
            </div>

            <div class="mb-3 position-relative">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control pe-5" required>
                <span class="position-absolute top-50" 
                    style="right: 10px; cursor: pointer;" 
                    onclick="togglePassword('new_password', this)">
                    Show
                </span>
            </div>

            <div class="mb-3 position-relative">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control pe-5" required>

                <span class="position-absolute top-50" 
                    style="right: 10px; cursor: pointer;" 
                    onclick="togglePassword('new_password_confirmation', this)">
                    Show
                </span>
            </div>


            <div class="justify-content-between mt-2">
                <a href="{{ url('/admin/profile') }}" class="btn btn-secondary px-4" style="background-color:rgb(35, 99, 59);">
                    Cancel
                </a>

                <button type="submit" class="btn btn-dark px-4" style="background-color: #343a40; border-color: #343a40;">
                    Update Password
                </button>
            </div>

        </form>
    </div>
</div>
<script>
    function togglePassword(inputId, iconElement) {
        const input = document.getElementById(inputId);
        const isPassword = input.type === 'password';

        input.type = isPassword ? 'text' : 'password';
        iconElement.textContent = isPassword ? 'Hide' : 'Show';
    }
</script>

@endsection
