<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Russ Cuevas</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  @vite(['resources/css/styles2.css'])
</head>
<body class="auth-page">
  <a href="/" class="close-auth"><i class="fas fa-times"></i></a>

  <div class="auth-bg-carousel">
    <div class="carousel-item active" style="background-image: url('/img/slide1.jpg');"></div>
    <div class="carousel-item" style="background-image: url('/img/slide2.webp');"></div>
    <div class="carousel-item" style="background-image: url('/img/slide3.jpg');"></div>
    <div class="auth-overlay"></div>
  </div>

  <div class="auth-card">
    <h1>Login</h1>

    @if ($errors->any())
        <div class="alert alert-danger" style="color: #721c24; background-color: rgba(248, 215, 218, 0.8); border: 1px solid #f5c6cb; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.8rem;">
            <ul style="list-style: none; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="post" class="auth-form">
      @csrf
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="email@example.com" value="{{ old('email') }}" required
          autocapitalize="off" autocomplete="off" autocorrect="off">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
      </div>

      <button type="submit" class="auth-btn">Login</button>

      <div class="auth-footer">
          <a href="/forget-password">Forgot your password?</a> 
          <a href="/signup">Don't have an account? Sign up</a>
          <a href="/">Return to Homepage</a>
      </div>
    </form>
  </div>

<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll('.carousel-item');
  
  function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }
  
  setInterval(nextSlide, 5000);
</script>

</body>
</html>
