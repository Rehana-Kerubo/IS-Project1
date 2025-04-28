@extends('vendor.sidebar')

@section('content')
<h1 class="h3 mb-4">Shop Dashboard</h1>

<form action="#" method=" " enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
    @csrf
    <div>
        <label class="block">Shop Name</label>
        <input type="text" name="shop_name" value="#" class="form-control">
    </div>

    <div>
        <label class="block">Shop Image</label><br>
        <img src="#" alt="Shop Image" class="img-thumbnail mb-3" style="width: 120px;"><br>
        <input type="file" name="shop_image">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@endsection
