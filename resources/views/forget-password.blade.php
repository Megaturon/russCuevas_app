<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password | Russ Cuevas</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  @vite(['resources/css/styles.css', 'resources/css/styles_forgetpass.css'])
</head>
<body>

  

  <!-- Forgot Password Form -->
  <div class="forgotpass-container">
    <h1>Forgot Password</h1>
    <!-- Step 1: Select verification method and submit contact info -->
    <form action="" method="post">
      <div class="method-selector">
        <input type="radio" id="email-method" name="verification_method" value="email" checked style="display: none;">
        <label for="email-method">Email Verification</label>
        
      </div>
      
      <div class="input-field email-field">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your registered email" required>
        
      </div>
      
      <div class="input-field phone-field" style="display: none;">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your registered phone number">
        
      </div>
      
      <div class="login-button">
        <button type="submit" name="send_code" id="sendCodeBtn">Send Verification Code</button>
      </div>
      
      <div class="login-links">
      <a href="/login" class="login-link" style="margin-bottom: -10px;">Back to Login</a>      </div>
    </form>

    <!-- Step 2: OTP Verification -->
    <form action="" method="post">
      <h3>
        PLACEHOLDER
      </h3>
      
      <p>
        We've sent a verification code to TO BE ADDED, FORGET PASSWORD FUNCTIONALITIES
      </p>
      
      <div class="input-field">
        <label for="otp">Enter 6-digit verification code</label>
        <input type="text" id="otp" name="otp" placeholder="Enter verification code" maxlength="6" required style="text-transform: none !important;">
      </div>
      
      <div class="otp-timer" id="otpTimer">
        Code expires in: <span id="timer">10:00</span>
      </div>
      
      <div class="form-buttons">
        <button type="submit" name="verify_otp">Verify Code</button>
        <button type="submit" name="resend_otp" id="resendBtn" disabled>Resend Code</button>
      </div>
      
      <div class="login-links">
        <form action="" method="post">
          <button type="submit" name="change_method" class="text-button login-link">Change Verification Method</button>
        </form>
      </div>
    </form>
  </div>

  <script>
    // Toggle visibility of email/phone fields based on selected method
    document.addEventListener('DOMContentLoaded', function() {
      const emailRadio = document.getElementById('email-method');
      const phoneRadio = document.getElementById('phone-method');
      const emailField = document.querySelector('.email-field');
      const phoneField = document.querySelector('.phone-field');
      
      if (emailRadio && phoneRadio) {
        emailRadio.addEventListener('change', function() {
          emailField.style.display = 'block';
          phoneField.style.display = 'none';
          document.getElementById('email').required = true;
          document.getElementById('phone').required = false;
        });
        
        phoneRadio.addEventListener('change', function() {
          emailField.style.display = 'none';
          phoneField.style.display = 'block';
          document.getElementById('email').required = false;
          document.getElementById('phone').required = true;
        });
      }
      
      // OTP Timer functionality
      const timerDisplay = document.getElementById('timer');
      const resendBtn = document.getElementById('resendBtn');
      
      if (timerDisplay && resendBtn) {
        let timeLeft = 600; // 10 minutes in seconds
        
        const countdown = setInterval(function() {
          if (timeLeft <= 0) {
            clearInterval(countdown);
            timerDisplay.textContent = "Expired";
            resendBtn.disabled = false;
            return;
          }
          
          const minutes = Math.floor(timeLeft / 60);
          const seconds = timeLeft % 60;
          
          timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
          timeLeft--;
        }, 1000);
        
        // Enable resend button after 1 minute
        setTimeout(function() {
          resendBtn.disabled = false;
        }, 60000);
      }
    });
  </script>
</body>
</html>