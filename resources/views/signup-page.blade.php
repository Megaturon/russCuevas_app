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
  <!-- Background Carousel -->
  <div class="login-bg-carousel">
    <div class="carousel-item active" style="background-image: url('/img/slide1.jpg');"></div>
    <div class="carousel-item" style="background-image: url('/img/slide2.webp');"></div>
    <div class="carousel-item" style="background-image: url('/img/slide3.jpg');"></div>
    <div class="bg-overlay"></div>
  </div>
  
  <div class="signup-container"> 
    <h1>Sign up</h1>

    @if ($errors->any())
        <div class="alert alert-danger" style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

	  <form action="{{ route('signup') }}" method="post">
      @csrf
	
	  <div class="user-details"> 
	    <div class="input-box"> 
	    <span> Full Name</span>
      <input type="text" name="fullname" placeholder="Enter your full name" value="{{ old('fullname') }}" required>
	  </div>
	
    <div class="input-box"> 
       <span>Address </span>
       <input type="text" name="address" placeholder="Enter your address" value="{{ old('address') }}" required>
    </div>

    <div class="input-box"> 
         <span>Email</span>
         <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" required> 
    </div>
	
      <div class="input-box"> 
          <label for="phone">Contact Number</label>
          <input type="number"  name="contact" id="contact" placeholder="Enter contact number" value="{{ old('contact') }}" required> 
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