@extends('vendor.sidebar')

@section('content')
<h1 class="h3 mb-4">Shop Dashboard</h1>

<form action="{{ route('vendor.update') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
    @csrf
    @method('PUT')
    <div>
        <label class="block">Shop Name</label>
        <input type="text" name="shop_name" value="{{ Auth::guard('buyer')->user()->vendor->shop_name }}" class="form-control">
    </div>

    <div>
        <label class="block">Shop Category</label><br>
        <input type="text" name="shop_category" value="{{ Auth::guard('buyer')->user()->vendor->shop_category }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@endsection
