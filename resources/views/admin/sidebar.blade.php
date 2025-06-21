<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <style>
        body {
            display: flex;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }

        aside {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 20px;
            position: fixed;
        }

        aside h2 {
            font-size: 1.5rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .menu-section {
            margin-bottom: 20px;
        }

        .menu-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #adb5bd;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .menu-link {
            display: block;
            color: white;
            text-decoration: none;
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 5px;
            transition: background 0.3s ease;
        }

        .menu-link:hover {
            background-color: #495057;
        }

        main {
            margin-left: 260px;
            padding: 40px;
            flex-grow: 1;
        }
    </style>
</head>
<body>

    <aside>
        <h2>Admin Panel</h2>

        <div class="menu-section">
            <div class="menu-title">User Management</div>
            <a href="{{ url('/admin/buyers') }}" class="menu-link">Buyers</a>
            <a href="{{ url('/admin/vendors') }}" class="menu-link">Vendors</a>
            <a href="{{ url('/admin/admins') }}" class="menu-link">Admins</a>
        </div>

        <div class="menu-section">
            <div class="menu-title">Flea Market</div>
            <a href="{{ url('/admin/announcements') }}" class="menu-link">Announcements</a>
            <a href="{{ url('/admin/stall-bookings') }}" class="menu-link">Stall Bookings</a>
        </div>

        <div class="menu-section">
            <div class="menu-title">System</div>
            <a href="{{ url('/admin/profile') }}" class="menu-link">Profile</a>
            <a href="{{ url('/') }}" class="menu-link">Logout</a>
        </div>
    </aside>

    <main>
        @yield('content')
    </main>

</body>
</html>
