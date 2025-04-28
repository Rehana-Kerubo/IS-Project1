<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Dashboard</title>

    <!-- Bootstrap CSS (official CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS styling -->
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        aside {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 20px;
        }

        aside h2 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        aside nav ul {
            list-style: none;
            padding: 0;
        }

        aside nav ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            transition: 0.3s;
        }

        aside nav ul li a:hover {
            text-decoration: underline;
            color: #0d6efd; /* Bootstrap primary color */
        }

        main {
            flex-grow: 1;
            background-color: #f8f9fa;
            padding: 40px;
        }
    </style>
</head>
<body>

    <aside>
        <h2>Vendor Panel</h2>
        <nav>
            <ul>
                <li><a href="{{ url('/vendor/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('/vendor/products') }}">Products</a></li>
                <li><a href="{{ url('/vendor/booked') }}">Bookings</a></li>
                <li><a href="{{ url('/vendor/analytics') }}">Analytics</a></li>
            </ul>
        </nav>
    </aside>

    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS (optional, for dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
