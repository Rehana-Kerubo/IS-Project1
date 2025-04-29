<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login / Sign Up</title>

  <!-- Link your CSS file -->
  <!-- <link rel="stylesheet" href="login.css"> -->
  <link rel="stylesheet" href="assets/css/login-register.css">

  <!-- Add a nice Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

  <div class="container" id="container">

    <!-- Sign Up Form -->
    <div class="form-container sign-up-container">
      <form action="#" method="POST">
        <h1>Create Account</h1>
        <input type="text" placeholder="Name" />
        <input type="email" placeholder="Email" />
        <input type="password" placeholder="Password" />
        <button>Sign Up</button>
        <hr>
        <button><a href="{{ route('google.redirect') }}" class="google">Use Google</a></button>
      </form>
    </div>

    <!-- Sign In Form -->
    <div class="form-container sign-in-container">
      <form action="#" method="#">
        <h1>Sign In</h1>
        <input type="email" placeholder="Email" />
        <input type="password" placeholder="Password" />
        <button>Sign In</button>
        <hr>
        <button><a href="{{ route('google.redirect') }}" class="google">Use Google</a></button>
      </form>
    </div>

    <!-- Overlay Panels -->
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>To stay connected with us, please login with your personal info</p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Welcome!</h1>
          <p>Enter your details and start your journey with us!</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>

  </div>

  <!-- Link your JavaScript file -->
  <!-- <script src="login.js"></script> -->
  <script src="assets/js/login-register.js"></script>      


</body>
</html>
