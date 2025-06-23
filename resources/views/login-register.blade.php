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
      <form action="#" method="">
        <h1>Create Account</h1>
        <input type="text" placeholder="Name" />
        <input type="email" placeholder="Email" />
        <input type="password" placeholder="Password" />
        <button style="width: 100%; border-radius: 30px; text-decoration: none; text-align: center; justify-content: center; margin-top: 8px;">Sign Up</button>
        <div style="text-align: center; margin-top: 10px; margin-bottom: 10px; background: #fff; width: fit-content; padding: 0 10px; margin-left: auto; margin-right: auto; color: #666;">
          or
      </div>
        <a href="{{ route('google.redirect') }}"
          style="
              display: inline-flex;
              align-items: center;
              justify-content: center;
              background-color: #ffffff;
              color: #555555;
              font-weight: 500;
              border: 1px solid #dddddd;
              border-radius: 8px;
              padding: 10px 20px;
              width: 100%;
              text-decoration: none;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
              transition: background-color 0.2s ease, box-shadow 0.2s ease;   "
              onmouseover="this.style.backgroundColor='#f5f5f5'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.15)';"
              onmouseout="this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 2px 4px rgba(0, 0, 0, 0.1)';">
              <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Icon"
            style="width: 20px; height: 20px; margin-right: 12px;">
          Continue with Google
        </a>

      </form>
    </div>

    <!-- Sign In Form -->
    <div class="form-container sign-in-container">
      <form action="#" method="#">
        <h1>Sign In</h1>
        <input type="email" placeholder="Email" />
        <input type="password" placeholder="Password" />
        <button style="width: 100%; border-radius: 30px; text-decoration: none; text-align: center; justify-content: center; margin-top: 8px;">Sign In</button>
        <div style="text-align: center; margin-top: 10px; margin-bottom: 10px; background: #fff; width: fit-content; padding: 0 10px; margin-left: auto; margin-right: auto; color: #666;">
          or
      </div>
        <a href="{{ route('google.redirect') }}"
          style="
              display: inline-flex;
              align-items: center;
              justify-content: center;
              background-color: #ffffff;
              color: #555555;
              font-weight: 500;
              border: 1px solid #dddddd;
              border-radius: 8px;
              padding: 10px 20px;
              width: 100%;
              text-decoration: none;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
              transition: background-color 0.2s ease, box-shadow 0.2s ease;   "
              onmouseover="this.style.backgroundColor='#f5f5f5'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.15)';"
              onmouseout="this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 2px 4px rgba(0, 0, 0, 0.1)';">
              <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Icon"
            style="width: 20px; height: 20px; margin-right: 12px;">
          Continue with Google
        </a>
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
