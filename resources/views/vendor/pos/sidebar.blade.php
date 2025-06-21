<!DOCTYPE html>
<html>
<head>
    <title>Vendor POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    {{-- Sidebar --}}
    <div class="bg-dark text-white p-3" style="min-width: 200px; min-height: 100vh;">
        <h5>POS Menu</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('vendor.pos') }}" class="nav-link text-white">POS</a></li>
            <li class="nav-item"><a href="{{ route('vendor.pos.inventory') }}" class="nav-link text-white">Inventory</a></li>
            <li class="nav-item"><a href="{{ route('vendor.pos.analytics') }}" class="nav-link text-white">Analytics</a></li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="p-4 w-100">
        @yield('content')
    </div>
</div>
</body>
</html>
