<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Russ Cuevas</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  @vite(['resources/css/styles2.css'])
</head>

<body>
<header>
  <x-nav-bar></x-nav-bar>
</header>

<main class="home">
  
  <!-- Gallery Section -->
  <div class="gallery-section" id="gallerySection" style="display: none;">
    <div class="gallery-title" id="galleryTitle">Gallery</div>
    <div class="gallery-container" id="galleryContainer">
      <!-- Gallery Images Load Here -->
    </div>
  </div>

  <!-- Image Overlay -->
  <div id="imageOverlay" class="overlay">
    <button class="close-btn" onclick="closeOverlay()">×</button>
    <button class="nav-btn prev-btn" onclick="prevImage()">❮</button>
    <button class="nav-btn next-btn" onclick="nextImage()">❯</button>
    <div id="overlayImages">
      <!-- Carousel will be inserted here by JavaScript -->
    </div>
  </div>

  <!-- Main Slider -->
  <div class="slider">
    <div class="list">
      <div class="item">
        <img src="/images/slide1.jpg" alt="Slide 1">
      </div>
      <div class="item">
        <img src="/images/slide2.webp" alt="Slide 2">
      </div>
      <div class="item">
        <img src="/images/slide3.jpg" alt="Slide 3">
      </div>
    </div>
    <ul class="dots">
      <li class="active"></li>
      <li></li>
      <li></li>
    </ul>

    <div class="home-overlay">
      <div class="home-content">
        <h1>Russ Cuevas Artelier</h1>
        <p>Quality work tailored to your needs</p>
        <div class="cta-container">
          <button class="book-btn" id="book-appointment">
            Book an Appointment
          </button>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Scripts -->
<script>
  // Gallery and Overlay Logic
  let currentImages = [];
  let currentIndex = 0;

  const galleryImages = {
  "Wedding Gown": [
    { thumbnail: "/images/wedding dress.jpg", images: ["/images/a1.jpg", "/images/a2.jpg", "/images/wedding dress.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] },
    { thumbnail: "/images/3.jpg", images: ["/images/3.jpg", "/images/4.jpg", "/images/5.jpg"] },
    { thumbnail: "/images/3.jpg", images: ["/images/3.jpg", "/images/4.jpg", "/images/5.jpg"] },
    { thumbnail: "/images/3.jpg", images: ["/images/3.jpg", "/images/4.jpg", "/images/5.jpg"] }
  ],
  "Principal Sponsor": [
    { thumbnail: "/images/3.jpg", images: ["/images/3.jpg", "/images/4.jpg", "/images/5.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] }
  ],
  "Evening Gown": [
    { thumbnail: "/images/3.jpg", images: ["/images/3.jpg", "/images/4.jpg", "/images/5.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] }
  ],
  "Formal Wear": [
    { thumbnail: "/images/3.jpg", images: ["/images/3.jpg", "/images/4.jpg", "/images/5.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] }
  ],
  "Prom": [
    { thumbnail: "/images/3.jpg", images: ["/images/3.jpg", "/images/4.jpg", "/images/5.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] },
    { thumbnail: "/images/wed2.jpg", images: ["/images/aweb2.jpg", "/images/aweb3.jpg", "/images/aweb2.jpg"] }
  ]
};

  function loadGallery(category) {
    const galleryTitle = document.getElementById("galleryTitle");
    const galleryContainer = document.getElementById("galleryContainer");
    const gallerySection = document.getElementById("gallerySection");
    const homeSection = document.querySelector(".slider"); // Get the home slider section

    // Close the dropdown menu
    document.getElementById('galleryDropdown').style.display = 'none';
    
    // Close mobile menu if open
    document.querySelector('.navbtns').classList.remove('active');
    document.getElementById('mobile-menu').classList.remove('active');
    
    // Hide home section and show gallery
    if (homeSection) {
      homeSection.style.display = "none";
    }

    galleryTitle.textContent = `Collections - ${category}`;
    galleryContainer.innerHTML = "";

    if (galleryImages[category]) {
      galleryImages[category].forEach(item => {
        const div = document.createElement("div");
        div.className = "gallery-item";

        const img = document.createElement("img");
        img.src = item.thumbnail;
        img.alt = category;

        img.addEventListener("click", function () {
          const overlay = document.getElementById("imageOverlay");
          const overlayImages = document.getElementById("overlayImages");

          overlayImages.innerHTML = "";
          currentImages = item.images;
          currentIndex = 0;

          // Create carousel container
          const carouselContainer = document.createElement("div");
          carouselContainer.className = "carousel-container";
          
          // Create carousel slider
          const carouselSlider = document.createElement("div");
          carouselSlider.className = "carousel-slider";
          
          // Create slides for each image
          currentImages.forEach((img, index) => {
            const slide = document.createElement("div");
            slide.className = "carousel-slide";
            
            // Position slides relative to center
            const offset = index - currentIndex;
            const width = 300; // Base width for slides
            
            slide.style.width = (index === currentIndex) ? '510px' : '510px';
            slide.style.left = `calc(50% - 175px + ${offset * (width * 0.8)}px)`;
            
            if (index === currentIndex) {
              slide.classList.add("active");
            }
            
            const imgElement = document.createElement("img");
            imgElement.src = img;
            imgElement.alt = category;
            
            slide.appendChild(imgElement);
            carouselSlider.appendChild(slide);
          });
          
          carouselContainer.appendChild(carouselSlider);
          overlayImages.appendChild(carouselContainer);
          
          overlay.style.display = "flex";
        });

        div.appendChild(img);
        galleryContainer.appendChild(div);
      });

      gallerySection.style.display = "block";
    }
  }

  // Add a function to go back to home from gallery
  function returnToHome() {
    document.getElementById("gallerySection").style.display = "none";
    document.querySelector(".slider").style.display = "block";
  }

  function closeOverlay() {
    document.getElementById("imageOverlay").style.display = "none";
  }

  function updateCarousel() {
    if (currentImages.length === 0) return;
    
    const slides = document.querySelectorAll('.carousel-slide');
    
    slides.forEach((slide, index) => {
      // Reset classes
      slide.classList.remove("active");
      
      // Position slides
      const offset = index - currentIndex;
      const width = 510; // Base width for slides
      
      // Set size based on position
      slide.style.width = (index === currentIndex) ? '530px' : '510px';
      
      // Position horizontally
      slide.style.left = `calc(50% - 175px + ${offset * (width * 0.8)}px)`;
      
      // Add active class to current slide
      if (index === currentIndex) {
        slide.classList.add("active");
      }
      
      // Set z-index based on distance from active
      slide.style.zIndex = 10 - Math.abs(offset);
      
      // Set opacity based on distance
      if (Math.abs(offset) > 2) {
        slide.style.opacity = 0;
      } else if (Math.abs(offset) > 1) {
        slide.style.opacity = 0.3;
      } else if (Math.abs(offset) === 1) {
        slide.style.opacity = 0.7;
      } else {
        slide.style.opacity = 1;
      }
    });
  }

  function prevImage() {
    if (currentImages.length <= 1) return;
    
    currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
    updateCarousel();
  }

  function nextImage() {
    if (currentImages.length <= 1) return;
    
    currentIndex = (currentIndex + 1) % currentImages.length;
    updateCarousel();
  }

  // Add keyboard event listeners for navigation
  document.addEventListener('keydown', function(e) {
    if (document.getElementById("imageOverlay").style.display === "flex") {
      if (e.key === "ArrowLeft") {
        prevImage();
      } else if (e.key === "ArrowRight") {
        nextImage();
      } else if (e.key === "Escape") {
        closeOverlay();
      }
    }
  });

  // Main slider initialization
  let slider = document.querySelector('.slider .list');
  let items = document.querySelectorAll('.slider .list .item');
  let dots = document.querySelectorAll('.slider .dots li');
  let active = 0;
  let lengthItems = items.length - 1;

  // Initialize slider
  function reloadSlider() {
  items.forEach(item => item.classList.remove('active'));
  dots.forEach(dot => dot.classList.remove('active'));

  items[active].classList.add('active');
  dots[active].classList.add('active');

  slider.style.left = `-${active * 100}vw`;
}

  // Auto slide
  let autoSlide = setInterval(() => {
    active = active >= lengthItems ? 0 : active + 1;
    reloadSlider();
  }, 5000);

  // Click on dots
  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      active = index;
      reloadSlider();
      clearInterval(autoSlide);
      autoSlide = setInterval(() => {
        active = active >= lengthItems ? 0 : active + 1;
        reloadSlider();
      }, 5000);
    });
  });

  // Initialize slider on page load
  reloadSlider();

  @if( $gallery == "wedding" )
    loadGallery('Wedding Gown');
  @elseif( $gallery == "sponsor" )
    loadGallery('Principal Sponsor');
  @elseif( $gallery == "evening" )
    loadGallery('Evening Gown');
  @elseif( $gallery == "formal" )
    loadGallery('Formal Wear');
  @elseif( $gallery == "prom" )
    loadGallery('Prom');
  @endif
</script>

</body>
</html>