<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Russ Cuevas</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  @vite(['resources/css/styles.css'])
</head>
<body>
  <!-- Login Form -->
  <div class="login-container">
    <h1>Login</h1>
    <form action="" method="post">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required
        autocapitalize="off" autocomplete="off" autocorrect="off" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required
        autocapitalize="off" autocomplete="off" autocorrect="off" required>

      <div class="login-links">
          <a href="/forget-password" id="forgot-pass-link" class="login-link">Forgot your password?</a> 

      <div class="login-button">
          <button type="submit" name="login" id="loginbtn">Login</button>
      </div>
          <a href="/signup" id="signup-link" class="login-link">Sign up for an account?</a>
          <a href="/" id="signup-link" class="login-link">Return to Homepage</a>
      </div>
  </form>
</div>

</body>
</html>
