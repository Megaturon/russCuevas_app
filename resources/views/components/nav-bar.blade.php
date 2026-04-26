@vite(['resources/js/navbar.js', 'resources/css/styles2.css'])

<nav class="navbar">
    <div class="nav-left">
      <div class="dropdown-wrapper">
        <button class="gallery-btn">Gallery</button>
        <ul class="luxury-dropdown" id="galleryDropdown">
          <li onclick="loadGallery('Wedding Gown')">Wedding Gown</li>
          <li onclick="loadGallery('Evening Gown')">Evening Wear</li>
          <li onclick="loadGallery('Prom')">Prom Collections</li>
        </ul>
      </div>
      <div class="dropdown-wrapper">
        <button class="about-btn">About Us</button>
        <ul class="luxury-dropdown" id="aboutDropdown">
          <li onclick="location.href='/faq'">Our Story</li>
          <li onclick="location.href='/faq'">FAQ</li>
          <li onclick="location.href='/terms'">Terms & Conditions</li>
        </ul>
      </div>
      <a href="/faq">Learn</a>
    </div>

    <div class="logo-container">
      <a href="/" class="logo">
        <img src="/images/RC_logo.jpg" alt="Russ Cuevas Logo">
      </a>
    </div>

    <div class="nav-right">
      <a href="{{ route('quote.index') }}" class="quote-link">Get a Quote</a>
      <a href="{{ route('appointments.index') }}" class="book-btn-nav">Book Now</a>
      <div class="icons">
        <div class="dropdown">
          <a class="login-btn">
            <img src="/img/user.png" alt="User Profile" width="20" height="20" class="user-icon-img">
          </a>
          <div class="dropdown-content">
            <ul class="dropdown-menu" id="loginDropdown" style="display: none;">
              <a href="/login"><li>Log In</li></a>
              @auth
              <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              @endauth
              <a href="/signup"><li>Sign Up</li></a>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="navbtns">
      <a href="/">Home</a>
      <a href="#" onclick="loadGallery('Wedding Gown')">Gallery</a>
      <a href="/faq">About</a>
      <a href="{{ route('quote.index') }}">Get a Quote</a>
      <a href="{{ route('appointments.index') }}">Book Now</a>
    </div>

    <div class="menu-toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
</nav>