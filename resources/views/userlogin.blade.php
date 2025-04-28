<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<style>
    /* Reset some defaults */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(to bottom right, #fff, #fff);
    }

    form {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px #07BEB8;
      width: 300px;
    }

    form div {
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      color: #000;
      font-weight: bold;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid;
      border-radius: 5px;
      background-color:rgb(248, 248, 248);
      transition: border-color 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #07BEB8;
      outline: none;
    }

    .login {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 10px;
      background-color: #3DCCC7;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .google {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 10px;
      background-color:rgb(9, 138, 133);
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
      color:rgb(0, 0, 0);
    }

    a {
      display: block;
      margin-top: 1rem;
      text-align: center;
      color: #3DCCC7;
      font-weight: bold;
      text-decoration: none;
      transition: color 0.3s;
    }

    a:hover {
      color: #07BEB8;
    }
</style>
</head>
<body>
    <!-- Login Form -->
<form method="POST" action="#">
    @csrf
    <!-- Email and Password -->
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <button class="login" type="submit">Login</button>

    <a href="{{ route('google.redirect') }}" class="google">Use your Google Account</a>

</form>

</body>
</html>