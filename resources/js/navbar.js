document.getElementById('mobile-menu').addEventListener('click', function () {
    document.querySelector('.navbtns').classList.toggle('active');
    this.classList.toggle('active');
});

// Gallery dropdown toggle
document.querySelector('.gallery-btn').addEventListener('click', function () {
    const dropdown = document.getElementById('galleryDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
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
  const isGalleryBtn = event.target.closest('.gallery-btn');
  const isDropdown = event.target.closest('#galleryDropdown');
	const isLoginBtn = event.target.closest('.login-btn');
	const isLoginDropdown = event.target.closest('#loginDropdown');
	const isAboutBtn = event.target.closest('.about-btn');
	const isAboutDropdown = event.target.closest('#aboutDropdown');
    
    // If click is outside gallery button and dropdown
    if (!isGalleryBtn && !isDropdown) {
      document.getElementById('galleryDropdown').style.display = 'none';
    }
	if (!isLoginBtn && !isLoginDropdown) {
      document.getElementById('loginDropdown').style.display = 'none';
    }
	if (!isAboutBtn && !isAboutDropdown) {
      document.getElementById('aboutDropdown').style.display = 'none';
    }
});