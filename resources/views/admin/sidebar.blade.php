<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/line-icons.css">
    <style>
        body {
            display: flex;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }

        aside {
            width: 250px;
            height: 100vh;
            background-color:rgb(60, 62, 150);
            color: #f1f1f1;
            padding: 20px;
            position: fixed;
        }

        .menu-section {
            margin-bottom: 20px;
        }

        .menu-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            color:rgb(192, 192, 192);
            margin-bottom: 10px;
            font-weight: bold;
            border-bottom: 1px solid rgb(166, 173, 181);
        }

        .menu-link {
            display: block;
            color: white;
            text-decoration: none;
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            transition: background 0.3s ease;
        }

        .menu-link:hover {
            background-color: rgb(72, 74, 180);
        }

        main {
            margin-left: 260px;
            padding: 40px;
            flex-grow: 1;
        }
        
        .admin-header h2 {
            font-size: 1.5rem;
            margin: 0;
            
        }
        .admin-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        .admin-header i {
            font-size: 28px;
        }
    </style>
</head>
<body>

    <aside>
    <div class="admin-header d-flex align-items-center gap-2">
    <i class="lni lni-stats-up"></i>
    <h2>Admin Panel</h2>
    </div>

        <div class="menu-section">
            <div class="menu-title">Vendor Management</div>
            <a href="{{ route('admin.analytics') }}" class="menu-link">Analytics</a>
            <a href="{{ route('admin.categories.create') }}" class="menu-link">Categories</a>
        </div>

        <div class="menu-section">
            <div class="menu-title">Flea Market</div>
            <a href="{{ url('/admin/announcements') }}" class="menu-link">Announcements</a>
            <a href="{{ url('/admin/stall-bookings') }}" class="menu-link">Stall Bookings</a>
        </div>

        <div class="menu-section">
            <div class="menu-title">System</div>
            <a href="{{ url('/admin/profile') }}" class="menu-link">Profile</a>
            <a href="{{ url('/admin/login') }}" class="menu-link">Logout</a>
        </div>
    </aside>

    <main>
        @yield('content')
    </main>

</body>
</html>
