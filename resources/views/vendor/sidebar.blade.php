<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Dashboard</title>

    <!-- Bootstrap + Lineicons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5fafa;
            display: flex;
            margin: 0;
        }

        aside {
            width: 240px;
            height: 100vh;
            background: #07BEB8;
            padding: 25px 20px;
            color: white;
            position: fixed;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.05);
        }

        aside h2 {
            font-size: 1.2rem;
            margin: 0;
            font-weight: 600;
        }
        main {
            margin-left: 240px;
            padding: 50px 40px;
            flex-grow: 1;
        }

        .account-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            max-width: 600px;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #07BEB8;
        }

        .edit-btn {
            background-color: #07BEB8;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .edit-btn:hover {
            background-color: #3DCCC7;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-title {
            color: #07BEB8;
            font-weight: 600;
        }

        .btn-danger {
            background-color: #FF6B6B;
            border: none;
        }

        .btn-danger:hover {
            background-color: #ff4c4c;
        }

        .badge-success {
            background-color: #07BEB8;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .badge-warning {
            background-color: #FFC107;
            color: black;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sidebar-header i {
            font-size: 1.3rem;
        }
        .menu-section {
            margin-top: 30px;
        }
        .menu-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            color: #e0f7f6;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 5px;
        }

        aside a {
            color: white;
            text-decoration: none !important;
            display: flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            font-size: 0.95rem;
            margin: 5px 0;
        }

        aside a:hover {
            background-color: #3DCCC7;
        }

    </style>
</head>
<body>

<aside>
    <div class="sidebar-header">
        <a href="{{ url()->previous() }}" style="color: white; text-decoration: none;" title="Back to Shop">
            <i class="lni lni-arrow-left"></i>
        </a>
        <h2>Hey {{ Auth::guard('buyer')->check() ? Auth::guard('buyer')->user()->full_name : 'Seller' }}🫶🏼</h2>
    </div>

    <div class="menu-section">
        <div class="menu-title">Details</div>
        <a href="{{ url('/vendor/dashboard') }}">Shop Dashboard</a>
        <a href="{{ url('/vendor/profile') }}">Profile</a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Manage Shop</div>
        <a href="{{ url('/vendor/products') }}">Products</a>
        <a href="{{ url('/vendor/booked') }}">Bookings</a>
        
    </div>

    @if(Auth::guard('buyer')->user()->vendor->status === 'verified')
    <div class="menu-section">
        <div class="menu-title">Flea Market</div>
        <a href="{{ url('/vendor/pos') }}">POS</a>
        
    </div>
    @else
    <div class="menu-section">
        <div class="menu-title">Flea Market</div>
        <a href="{{ url('/vendor/book-stall') }}">Book a Stall</a>
    </div>
    @endif

    <div class="menu-section">
        <div class="menu-title">System</div>
        <a href="{{ url('/') }}">Log Out</a>
    </div>
</aside>

<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
