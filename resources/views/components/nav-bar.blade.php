@vite(['resources/js/navbar.js', 'resources/css/styles2.css'])

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <a href="/" class="logo">
      <img src="/images/RC_logo.jpg" alt="Russ Cuevas Logo">
    </a>

    <div class="menu-toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>

    <div class="navbtns">
      <a class="gallery-btn">Gallery</button>
      <ul class="dropdown-menu" id="galleryDropdown" style="display: none;">
        <li>Bridal ⯆
          <ul class="sub-menu">
            <li onclick="location.href = '/main/wedding';">Wedding Gown</li>
            <li onclick="location.href = '/main/sponsor';">Principal Sponsor</li>
          </ul>
        </li>
        <li>Evening Wear ⯆
          <ul class="sub-menu">
            <li onclick="location.href = '/main/evening';">Evening Gown</li>
            <li onclick="location.href = '/main/formal';">Formal Wear</li>
          </ul>
        </li>
        <li onclick="location.href = '/main/prom';">Prom</li>
        
      </ul>
	  <a class="about-btn">About Us</button>
		<ul class="dropdown-menu" id="aboutDropdown" style="display: none;">	
			<li onclick="location.href = '/faq';">FAQ</li>
			<li onclick="location.href = '/terms';">Terms and Conditions</li>
			<li onclick="location.href = '/privacy';">Private Policy</li>
		</ul>
      <a href="/appointments">Book Appointment</a>
      <a href="/get-a-quote">Get A Quote</a>

    </div>

    <div class="icons">    
		<div class = "dropdown">
            <a class="login-btn">
				<img src="/images/user.png" alt="User Profile" width="40" height="40">
			</a>
			<div class = "dropdown-content">
			 <ul class="dropdown-menu" id="loginDropdown" style="display: none;">
					<a href = "/login"><li>Log In</li></a>
					<li>Log Out</li>
				  <a href = "/signup"><li>Sign Up</li></a>
			 </ul>
			</div>
		</div>
    </div>
</nav>