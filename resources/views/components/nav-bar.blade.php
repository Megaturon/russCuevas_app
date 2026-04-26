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
              @guest
              <a href="/login"><li>Log In</li></a>
              <a href="/signup"><li>Sign Up</li></a>
              @else
              <li style="padding: 10px 20px; font-weight: 600; font-size: 0.7rem; border-bottom: 1px solid #eee;">{{ auth()->user()->name }}</li>
              <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="cursor: pointer; padding: 10px 20px;">Log Out</li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              @endguest
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="menu-toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Dropdown toggle for user icon
    const loginBtn = document.querySelector('.login-btn');
    const loginDropdown = document.getElementById('loginDropdown');
    
    if (loginBtn && loginDropdown) {
        loginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            loginDropdown.style.display = loginDropdown.style.display === 'none' ? 'block' : 'none';
        });
        
        document.addEventListener('click', function() {
            loginDropdown.style.display = 'none';
        });
    }

    // Mobile menu toggle
    const mobileMenu = document.getElementById('mobile-menu');
    const navLeft = document.querySelector('.nav-left');
    const navRight = document.querySelector('.nav-right');

    if (mobileMenu) {
      mobileMenu.addEventListener('click', function() {
        this.classList.toggle('is-active');
        // Add active classes for mobile view if CSS handles it via .active
        navLeft?.classList.toggle('active');
        navRight?.classList.toggle('active');
      });
    }
  });
</script>