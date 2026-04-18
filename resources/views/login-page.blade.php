<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Russ Cuevas</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  @vite(['resources/css/styles.css'])
</head>
<body>
  <!-- Background Carousel -->
  <div class="login-bg-carousel">
    <div class="carousel-item active" style="background-image: url('/img/slide1.jpg');"></div>
    <div class="carousel-item" style="background-image: url('/img/slide2.webp');"></div>
    <div class="carousel-item" style="background-image: url('/img/slide3.jpg');"></div>
    <div class="bg-overlay"></div>
  </div>

  <!-- Login Form -->
  <div class="login-container">
    <h1>Login</h1>

    @if ($errors->any())
        <div class="alert alert-danger" style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="post">
      @csrf
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required
        autocapitalize="off" autocomplete="off" autocorrect="off">


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
