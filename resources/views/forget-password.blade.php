<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
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
      <div class="carousel-item active" style="background-image: url('/img/orange.png');"></div>
      <div class="auth-overlay"></div>
    </div>

    <div class="auth-card" style="max-width: 500px;">
      <h1>Reset Password</h1>

      @if ($errors->any())
          <div class="alert alert-danger" style="color: #721c24; background-color: rgba(248, 215, 218, 0.8); border: 1px solid #f5c6cb; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.8rem;">
              <ul style="list-style: none; padding: 0;">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if(session('success'))
          <div class="alert alert-success" style="color: #155724; background-color: rgba(212, 237, 218, 0.8); border: 1px solid #c3e6cb; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.8rem; text-align: center;">
              {{ session('success') }}
          </div>
      @endif

      @if(session('status') != 'code_sent')
        <p style="text-align: center; font-size: 0.85rem; color: var(--text-muted); margin-top: -30px; margin-bottom: 40px;">
            Enter your email to receive a verification code.
        </p>

        <!-- Step 1: Send Code -->
        <form action="{{ route('password.email') }}" method="post" class="auth-form" id="forgetPassForm">
            @csrf
            <div class="form-group">
            <label for="email">Email Address <span class="required-asterisk">*</span></label>
            <input type="email" id="email" name="email" placeholder="Enter your registered email" value="{{ old('email') }}" required>
            </div>
            
            <div class="auth-links" style="justify-content: center;">
            <a href="/login" class="auth-link">Return to Sign In</a>
            </div>

            <button type="submit" name="send_code" class="auth-btn">Send Verification Code</button>
        </form>
      @else
        <!-- Step 2: OTP Verification -->
        <div id="otpSection" style="margin-top: 10px;">
            <h3 style="font-family: var(--font-serif); font-size: 1.2rem; text-align: center; margin-bottom: 15px;">Verify Code</h3>
            <p style="text-align: center; font-size: 0.75rem; color: var(--text-muted); margin-bottom: 25px;">
            We've sent a 6-digit code to <strong>{{ session('reset_email') }}</strong>.
            </p>

            <form action="{{ route('password.verify') }}" method="post" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="otp">Verification Code <span class="required-asterisk">*</span></label>
                <input type="text" id="otp" name="otp" placeholder="000000" maxlength="6" required style="text-align: center; letter-spacing: 5px; font-size: 1.2rem;">
            </div>

            <div style="text-align: center; font-size: 0.7rem; color: var(--text-muted); margin-bottom: 20px;" id="otpTimer">
                Code expires in: <span id="timer" style="font-weight: 500; color: var(--primary-color);">10:00</span>
            </div>

            <div class="auth-links" style="justify-content: center; gap: 20px;">
                <a href="/forget-password" class="auth-link">Change Email</a>
            </div>

            <button type="submit" name="verify_otp" class="auth-btn">Verify & Continue</button>
            </form>
        </div>

        <script>
            // Simple timer for the OTP
            let timeLeft = 600; // 10 minutes
            const timerElement = document.getElementById('timer');
            const countdown = setInterval(() => {
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                timerElement.innerHTML = `${minutes}:${seconds}`;
                timeLeft--;
                if (timeLeft < 0) {
                    clearInterval(countdown);
                    timerElement.innerHTML = "Expired";
                    timerElement.style.color = "red";
                }
            }, 1000);
        </script>
      @endif
    </div>
  </div>
</body>
</html>
