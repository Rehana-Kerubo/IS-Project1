<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buyer Dashboard')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5fafa;
            display: flex;
        }

        aside {
            width: 220px;
            height: 100vh;
            background: #07BEB8;
            padding: 20px;
            color: white;
            position: fixed;
        }

        aside h2 {
            font-size: 1.3rem;
            margin-bottom: 20px;
        }

        aside nav ul {
            list-style: none;
            padding: 0;
        }

        aside nav ul li {
            margin: 15px 0;
        }

        aside nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        aside nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            margin-left: 240px;
            padding: 40px;
            flex-grow: 1;
        }

        .account-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .edit-btn {
            background-color: #07BEB8;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
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
}

.badge-warning {
    background-color: #FFC107;
    color: black;
    padding: 6px 14px;
    border-radius: 20px;
}

    </style>
</head>
<body>
<aside>
    <div style="display: flex; align-items: center; justify-content: space-between;">
        <a href="{{ url('/buyer/landing') }}" style="color: white; text-decoration: none; font-size: 20px;" title="Back to Shop">
        <i class="lni lni-arrow-left" style="margin-left: 10px;"></i>
        </a>
        <h2 style="margin: 0;">Hey {{ Auth::check() ? Auth::user()->full_name : 'Customer' }}🫶🏼</h2>
    </div>

    <nav>
        <ul>
            <li><a href="{{ url('/buyer/view-acc') }}">View Account</a></li>
            <li><a href="{{ url('/buyer/b-products') }}">Booked Products</a></li>
            <li><a href="{{ url('/buyer/be-vendor') }}">Become a Vendor</a></li>
            <li><a href="{{ url('/') }}">Log Out</a></li>

        </ul>
    </nav>
</aside>

<main>
    @yield('content')
</main>
</body>
</html>
