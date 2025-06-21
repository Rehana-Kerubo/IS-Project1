@extends('admin.sidebar')

@section('content')
<h1 class="h3 mb-4">Shop Dashboard</h1>

<form action=" {{ route('admin.profile') }} " method="POST" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
    @csrf
    @method('PUT')
    <div>
        <label class="block">Full Name</label>
        <input type="text" name="full_name" value="{{ Auth::guard('admin')->user()->full_name }}" class="form-control">
    </div>

    <div>
        <label class="block">Email</label><br>
        <input type="text" name="email" value="{{ Auth::guard('admin')->user()->email }}">
    </div>
</form>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@endsection
