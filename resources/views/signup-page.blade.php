<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Russ Cuevas</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  @vite(['resources/css/styles.css'])
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

</head>
<body>

  <!-- Header copied in directly -->
  <!-- Signup Form -->
  
  <div class="signup-container"> 
    <h1>Sign up</h1>
	  <form action="" method="post">
	
	  <div class="user-details"> 
	    <div class="input-box"> 
	    <span> Full Name</span>
      <input type="text" name="fullname" placeholder="Enter your full name" required>
	  </div>
	
    <div class="input-box"> 
       <span>Address </span>
       <input type="text" name="address" placeholder="Enter your address" required>
    </div>

    <div class="input-box"> 
         <span>Email</span>
         <input type="email" name="email" placeholder="your@email.com" required> 
    </div>
	
      <div class="input-box"> 
          <label for="phone">Contact Number</label>
          <input type="number"  name="contact" id="contact" placeholder="Enter contact number" required> 
      </div>
	
      <div class="input-box pass-box"> 
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Enter your password" required>  
      </div>
    </div>

    <!-- Fix here: add login-links class -->
    <div class="login-links">
      <button type="submit" name="register" id="create-button" class="create-btn">Create Account</button>
      <a href="/login" id="signup-link" class="login-link">Already have an account?</a>
    </div>
  </form>
</div>

</body>
</html>