<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>FAQ - Russ Cuevas Artelier</title>
    
    <!-- React, ReactDOM, and Babel Scripts -->
    <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header>
  <nav class="navbar">
    <a href="RC.php" class="logo">
      <img src="img/RC_logo.jpg" alt="Russ Cuevas Logo">
    </a>

    <div class="menu-toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>

    <div class="navbtns">
      <a href="RC.php">Gallery</a>
      <a class="about-btn">About Us</button>
		<ul class="dropdown-menu" id="aboutDropdown" style="display: none;">
			
				<li onclick="location.href = 'faq.php';">FAQ</li>
				<li onclick="location.href = 'terms.php';">Terms and Conditions</li>
				<li onclick="location.href = 'privacy.php';">Private Policy</li>
		</ul>
      <a href="getAppointment.php">Book Appointment</a>
      <a href="getAQuote.php">Get A Quote</a>
    </div>
	
	<div class="icons">    
		<div class = "dropdown">
            <a class="login-btn">
				<img src="img/user.png" alt="User Profile" width="40" height="40">
			</a>
			<div class = "dropdown-content">
			 <ul class="dropdown-menu" id="loginDropdown" style="display: none;">
				<?php if(empty($logged_email)){?>
					<a href = "login.php"><li>Log In</li></a>
				<?php } else {?>
					<a href = "?logOut"><li>Log Out</li></a>
				<?php }?>
				<a href = "signup.php"><li>Sign Up</li></a>
			 </ul>
			</div>
		</div>
    </div>

  </nav>
</header>

    <main class="quote-page">
        <div class="quote-container">
		<p>FAQ</p>
        </div>
    </main>
	
	<script>
        const faqItems = document.querySelectorAll('.faq-item');
    
        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                faqItems.forEach(i => {
                    if (i !== item) i.classList.remove('open');
                });
                item.classList.toggle('open');
            });
        });
    </script>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.querySelector('.navbtns').classList.toggle('active');
            this.classList.toggle('active');
        });
		
		document.querySelector('.login-btn').addEventListener('click', function () {
    const dropdown = document.getElementById('loginDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
  });
  
  document.querySelector('.about-btn').addEventListener('click', function () {
    const dropdown = document.getElementById('aboutDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
  });

  // Close dropdowns when clicking outside
  document.addEventListener('click', function(event) {
	const isLoginBtn = event.target.closest('.login-btn');
	const isLoginDropdown = event.target.closest('#loginDropdown');
	const isAboutBtn = event.target.closest('.about-btn');
	const isAboutDropdown = event.target.closest('#aboutDropdown');
    
    // If click is outside gallery button and dropdown
	if (!isLoginBtn && !isLoginDropdown) {
      document.getElementById('loginDropdown').style.display = 'none';
    }
	if (!isAboutBtn && !isAboutDropdown) {
      document.getElementById('aboutDropdown').style.display = 'none';
    }
  });
  
  
    </script>
	
</body>
</html>
