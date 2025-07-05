<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buyer Dashboard')</title>
    
    <!-- Bootstrap + Lineicons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet" />
    
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

        aside nav ul {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }

        aside nav ul li {
            margin: 20px 0;
            padding: 10px 0;
        }

        aside nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }

        aside nav ul li a:hover {
            text-decoration: none;
            color: #FDFDFD;
            transform: translateX(4px);
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
    </style>
</head>
<body>
<aside>
    <div class="sidebar-header">
        <a href="{{ url()->previous() }}" style="color: white; text-decoration: none;" title="Back to Shop">
            <i class="lni lni-arrow-left"></i>
        </a>
        <h2>Hey {{ Auth::check() ? Auth::user()->full_name : 'Customer' }}🫶🏼</h2>
    </div>

    <nav>
        <ul>
            <li><a href="{{ url('/buyer/view-acc') }}"><i class="lni lni-user mr-2"></i>View Account</a></li>
            <li><a href="{{ url('/buyer/b-products') }}"><i class="lni lni-package mr-2"></i>Wishlist</a></li>
            <li><a href="{{ url('/buyer/be-vendor') }}"><i class="lni lni-briefcase mr-2"></i>Become a Vendor</a></li>
            <li><a href="{{ url('/') }}"><i class="lni lni-exit mr-2"></i>Log Out</a></li>
        </ul>
    </nav>
</aside>

<main>
    @yield('content')
</main>

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
