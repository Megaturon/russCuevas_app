<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Russ Cuevas</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  
  @vite(['resources/css/styles2.css'])
</head>
<body class="auth-page">
  <header>
    <x-nav-bar></x-nav-bar>
  </header>
  
  <a href="/" class="close-auth"><i class="fas fa-times"></i></a>

  <div class="auth-centered-wrapper">
    <div class="auth-bg-carousel">
      <div class="carousel-item active" style="background-image: url('/img/slide3.jpg');"></div>
      <div class="auth-overlay"></div>
    </div>

    <div class="auth-card" style="max-width: 500px;">
      <h1>Reset Password</h1>
      <p style="text-align: center; font-size: 0.85rem; color: var(--text-muted); margin-top: -30px; margin-bottom: 40px;">
        Enter your email to receive a verification code.
      </p>

      <!-- Step 1: Send Code -->
      <form action="" method="post" class="auth-form" id="forgetPassForm">
        @csrf
        <div class="form-group">
          <label for="email">Email Address <span class="required-asterisk">*</span></label>
          <input type="email" id="email" name="email" placeholder="Enter your registered email" required>
        </div>
        
        <div class="auth-links" style="justify-content: center;">
          <a href="/login" class="auth-link">Return to Sign In</a>
        </div>

        <button type="submit" name="send_code" class="auth-btn">Send Verification Code</button>
      </form>

      <!-- Step 2: OTP (Hidden by default until functionality is added) -->
      <!-- In a real implementation, you'd toggle visibility based on session/state -->
      <div id="otpSection" style="display: none; margin-top: 30px; border-top: 1px solid var(--border-light); padding-top: 30px;">
        <h3 style="font-family: var(--font-serif); font-size: 1.2rem; text-align: center; margin-bottom: 15px;">Verify Code</h3>
        <p style="text-align: center; font-size: 0.75rem; color: var(--text-muted); margin-bottom: 25px;">
          We've sent a 6-digit code to your email.
        </p>

        <form action="" method="post" class="auth-form">
          @csrf
          <div class="form-group">
            <label for="otp">Verification Code <span class="required-asterisk">*</span></label>
            <input type="text" id="otp" name="otp" placeholder="000000" maxlength="6" required style="text-align: center; letter-spacing: 5px; font-size: 1.2rem;">
          </div>

          <div style="text-align: center; font-size: 0.7rem; color: var(--text-muted); margin-bottom: 20px;" id="otpTimer">
            Code expires in: <span id="timer" style="font-weight: 500; color: var(--primary-color);">10:00</span>
          </div>

          <div class="auth-links" style="justify-content: center; gap: 20px;">
             <button type="submit" name="resend_otp" id="resendBtn" disabled style="background: none; border: none; font-family: var(--font-sans); font-size: 0.75rem; color: var(--text-muted); cursor: pointer; text-decoration: underline;">Resend Code</button>
          </div>

          <button type="submit" name="verify_otp" class="auth-btn">Verify & Continue</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Logic for demo/testing visibility (optional)
    // In actual use, this would be handled by PHP backend conditions
    document.addEventListener('DOMContentLoaded', function() {
        const timerDisplay = document.getElementById('timer');
        const resendBtn = document.getElementById('resendBtn');
        
        if (timerDisplay && resendBtn) {
            let timeLeft = 600; 
            const countdown = setInterval(function() {
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    timerDisplay.textContent = "Expired";
                    resendBtn.disabled = false;
                    resendBtn.style.color = "var(--primary-color)";
                    return;
                }
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                timeLeft--;
            }, 1000);
        }
    });
  </script>
</body>
</html>