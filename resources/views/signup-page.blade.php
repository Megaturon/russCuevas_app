<!DOCTYPE html>
<html lang="en">
<head>
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
      <div class="carousel-item active" style="background-image: url('/img/slide1.jpg');"></div>
      <div class="carousel-item" style="background-image: url('/img/slide2.webp');"></div>
      <div class="carousel-item" style="background-image: url('/img/slide3.jpg');"></div>
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
                <input type="text" id="fullname" name="name" value="{{ old('name') }}" required placeholder="Enter your name">
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
                <input type="password" id="password" name="password" required placeholder="Create a password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password <span class="required-asterisk">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
            </div>
        </div>

        <div class="auth-links" style="justify-content: center;">
          <a href="/login" class="auth-link">Already have an account? Sign In</a>
        </div>

        <button type="submit" class="auth-btn">Create Account</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.carousel-item');
        let current = 0;
        
        setInterval(() => {
            items[current].classList.remove('active');
            current = (current + 1) % items.length;
            items[current].classList.add('active');
        }, 5000);
    });
  </script>
</body>
</html>