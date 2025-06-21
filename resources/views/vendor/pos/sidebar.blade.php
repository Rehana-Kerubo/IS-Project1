<!DOCTYPE html>
<html>
<head>
    <title>Vendor POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">

    <style>
        
        .sidebar {
            background-color: #07BEB8;
            color: white;
            min-height: 100vh;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #3DCCC7;
        }
        .btn-custom {
            background-color: #3DCCC7;
            border: none;
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #07BEB8;
        }
        .form-container, .table-container {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    {{-- Sidebar --}}
    <div class="sidebar p-3" style="min-width: 200px;">
       <div class="d-flex align-items-center mb-3">
        <a href="{{ url('/vendor/dashboard') }}" title="Back to Dashboard" style="color: white; text-decoration: none; font-size: 20px; display: flex; align-items: center;">
            <i class="lni lni-arrow-left me-2"></i>
         </a>
            <h5 class="fw-bold">POS Menu</h5>
       
    </div>

        <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('vendor.pos') }}">POS</a></li>
            <li class="nav-item"><a href="{{ route('vendor.pos.inventory') }}">Inventory</a></li>
            <li class="nav-item"><a href="{{ route('vendor.pos.analytics') }}">Analytics</a></li>
        </ul>
</div>

    {{-- Main Content --}}
    <div class="p-4 w-100">
        @yield('content')
    </div>
</div>
</body>
</html>
