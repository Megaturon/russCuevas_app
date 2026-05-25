<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Russ Cuevas</title>
  
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
      <div class="carousel-item active" style="background-image: url('/img/slide2.webp');"></div>
      <div class="auth-overlay"></div>
    </div>

    <div class="auth-card" style="max-width: 500px;">
      <h1>New Password</h1>
      <p style="text-align: center; font-size: 0.85rem; color: var(--text-muted); margin-top: -30px; margin-bottom: 40px;">
        Please create a new secure password for your account.
      </p>

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

      <form action="{{ route('password.update') }}" method="post" class="auth-form">
        @csrf
        <div class="form-group">
          <label for="password">New Password <span class="required-asterisk">*</span></label>
          <div class="password-field" style="position: relative">
            <input type="password" id="password" name="password" placeholder="Minimum 8 characters" required>
            <button type="button" id="toggle-pass"
              style="position: absolute; inset-block: 0; right: 0; display: grid; place-items: center; padding-inline: 3; margin-right: 15px; font-size:var(--text-sm); overflow: hidden; outline: none; background-color: transparent; border: none; opacity: 0.5;"
              aria-label="Toggle password visibility" style="color: var(--muted-foreground);"><i
              class="fa-solid fa-eye"></i></button>
          </div>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirm New Password <span class="required-asterisk">*</span></label>
          <div class="password-confirm-field" style="position: relative">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password" required>
            <button type="button" id="toggle-pass-confirm"
              style="position: absolute; inset-block: 0; right: 0; display: grid; place-items: center; padding-inline: 3; margin-right: 15px; font-size:var(--text-sm); overflow: hidden; outline: none; background-color: transparent; border: none; opacity: 0.5;"
              aria-label="Toggle password visibility" style="color: var(--muted-foreground);"><i
              class="fa-solid fa-eye"></i></button>
          </div>
        </div>

        <button type="submit" class="auth-btn">Update Password</button>
      </form>
    </div>
  </div>

  <script>

    const loginPassword = document.querySelector('#password');
    const togglePass = document.querySelector('#toggle-pass');
    const confirmPassword = document.querySelector('#password_confirmation');
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
            if (icon_confirm) {
                const isText = nextType_confirm === 'text';
                icon_confirm.classList.toggle('fa-eye', !isText);
                icon_confirm.classList.toggle('fa-eye-slash', isText);
            }
        });    
    }

  </script>  
</body>
</html>
