<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Russ Cuevas</title>
  
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
      <div class="carousel-item active" style="background-image: url('/img/orange.png'); background-position: center top;"></div>
      <div class="carousel-item" style="background-image: url('/img/model2.jpg'); background-position: center top;"></div>
      <div class="carousel-item" style="background-image: url('/img/whitem.png'); background-position: center 20%;"></div>
      <div class="auth-overlay"></div>
    </div>

    <div class="auth-card" style="max-width: 600px;">
      <h1>Create Account</h1>

      @if ($errors->any())
          <div class="alert alert-danger" style="color: #721c24; background-color: rgba(248, 215, 218, 0.8); border: 1px solid #f5c6cb; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.8rem;">
              <ul style="list-style: none; padding: 0;">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form action="{{ route('signup') }}" method="post" class="auth-form">
        @csrf
        <div class="signup-grid">
            <div class="form-group">
                <label for="fullname">Full Name <span class="required-asterisk">*</span></label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required placeholder="Enter your name">
            </div>

            <div class="form-group">
                <label for="email">Email Address <span class="required-asterisk">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="contact">Contact Number <span class="required-asterisk">*</span></label>
                <input type="text" id="contact" name="contact" value="{{ old('contact') }}" required placeholder="Enter your phone number">
            </div>

            <div class="form-group">
                <label for="address">Address <span class="required-asterisk">*</span></label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required placeholder="Enter your address">
            </div>

            <div class="form-group">
                <label for="password">Password <span class="required-asterisk">*</span></label>
                <div class="password-field" style="position: relative">
                    <input type="password" id="password" name="password" required placeholder="Create a password">
                    <button type="button" id="toggle-pass"
                        style="position: absolute; inset-block: 0; right: 0; display: grid; place-items: center; padding-inline: 3; margin-right: 15px; font-size:var(--text-sm); overflow: hidden; outline: none; background-color: transparent; border: none; opacity: 0.5;"
                        aria-label="Toggle password visibility" style="color: var(--muted-foreground);"><i
                        class="fa-solid fa-eye"></i></button>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirmation">Confirm Password <span class="required-asterisk">*</span></label>
                <div class="confirm-field" style="position: relative">
                    <input type="password" id="password-confirmation" name="password-confirmation" required placeholder="Confirm your password">
                    <button type="button" id="toggle-pass-confirm"
                        style="position: absolute; inset-block: 0; right: 0; display: grid; place-items: center; padding-inline: 3; margin-right: 15px; font-size:var(--text-sm); overflow: hidden; outline: none; background-color: transparent; border: none; opacity: 0.5;"
                        aria-label="Toggle password visibility" style="color: var(--muted-foreground);"><i
                        class="fa-solid fa-eye"></i></button>
                </div>
            </div>
        </div>

        <div class="auth-links" style="justify-content: center;">
          <a href="/login" class="auth-link">Already have an account? Sign In</a>
        </div>

        <button type="submit" class="auth-btn">Create Account</button>
        
        <div style="text-align: center; margin: 15px 0; position: relative;">
            <hr style="border-top: 1px solid #ccc; margin: 0; position: absolute; width: 100%; top: 50%; z-index: 1;">
            <span style="background: var(--bg-color, white); padding: 0 10px; position: relative; z-index: 2; color: #666; border-radius: 4px;">or</span>
        </div>

        <a href="/auth/google" class="auth-btn" style="background-color: #fff; color: #333; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; gap: 10px; text-decoration: none;">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 18px; height: 18px;">
            Sign up with Google
        </a>
      </form>
    </div>
  </div>

  <script>
    function togglePasswordVisibility(inputId, icon) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.carousel-item');
        let current = 0;
        
        setInterval(() => {
            items[current].classList.remove('active');
            current = (current + 1) % items.length;
            items[current].classList.add('active');
        }, 5000);
    });

    const loginPassword = document.querySelector('#password');
    const togglePass = document.querySelector('#toggle-pass');
    const confirmPassword = document.querySelector('#password-confirmation');
    const togglePassConfirm = document.querySelector('#toggle-pass-confirm');

    if (togglePass && loginPassword) {
        togglePass.addEventListener('click', () => {
            const nextType = loginPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            loginPassword.setAttribute('type', nextType);

            const icon = togglePass.querySelector('i');
            if (icon) {
                const isText = nextType === 'text';
                icon.classList.toggle('fa-eye', !isText);
                icon.classList.toggle('fa-eye-slash', isText);
            }
        });
    }

    if (togglePassConfirm && confirmPassword) {
        togglePassConfirm.addEventListener('click', () => {
            const nextType_confirm = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', nextType_confirm);

            const icon_confirm = togglePassConfirm.querySelector('i');
            if (icon) {
                const isText = nextType_confirm === 'text';
                icon_confirm.classList.toggle('fa-eye', !isText);
                icon_confirm.classList.toggle('fa-eye-slash', isText);
            }
        });    
    }

  </script>
</body>
</html>
