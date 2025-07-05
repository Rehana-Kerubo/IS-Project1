<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            background: url('/assets/img/landing2.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
            z-index: 1;
        }

        .login-container {
            background-color:rgba(255, 255, 255, 0.66);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding-right: 60px;
        }

        .login-container h3 ,h2{
            text-align: center;
            margin-bottom: 10px;
            color: #1d3557;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .btn-primary {
            width: 430px;
            padding: 12px;
            background-color: #343a40;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color:rgb(76, 84, 90);
        }

        .error-message {
            color: #e63946;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
    <h3><a href="/" style="text-decoration: none; color:rgb(0, 112, 107);">Visit Flea Market Landing</a></h3>

        
        <h2>Admin Login</h2>
        

        @if(session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" class="form-control" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                <span class="position-absolute top-50"  
                    onclick="togglePassword('password', this)">
                    Show Password
                </span>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Log In</button><br>
        </form>
    </div>
</body>
</html>
<script>
    function togglePassword(inputId, iconElement) {
        const input = document.getElementById(inputId);
        const isPassword = input.type === 'password';

        input.type = isPassword ? 'text' : 'password';
        iconElement.textContent = isPassword ? 'Hide Password' : 'Show Password';
    }
</script>
