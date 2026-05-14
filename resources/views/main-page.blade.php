<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Russ Cuevas</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  @vite(['resources/css/styles2.css'])
  <style>
    html {
        scroll-behavior: smooth;
    }
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(50px);
        transition: all 1s ease-out;
    }
    .reveal-on-scroll.scrolled-in {
        opacity: 1;
        transform: translateY(0);
    }
    .gallerySwiper .swiper-slide {
        width: 256px !important;
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .gallerySwiper .swiper-slide {
            width: 192px !important;
        }
    }
    .gallery-carousel-section {
        padding-top: 2rem;
        padding-bottom: 2rem;
        max-height: 800px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .gallery-carousel-section .overflow-hidden {
        width: 100%;
    }
    .gallerySwiper .swiper-wrapper {
        align-items: center;
    }
    .gallery-heading {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 400;
        font-style: italic;
        color: #1a1a1a;
        line-height: 1;
        letter-spacing: -1px;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    /* Masonry Layout */
    .mp-masonry-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .mp-masonry-large {
        grid-row: span 2;
        min-height: 600px;
        background-size: cover;
        background-position: center;
        position: relative;
        cursor: pointer;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .mp-masonry-small-col {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .mp-masonry-small {
        flex: 1;
        min-height: 290px;
        background-size: cover;
        background-position: center;
        position: relative;
        cursor: pointer;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .mp-card-hover {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .mp-masonry-large:hover .mp-card-hover,
    .mp-masonry-small:hover .mp-card-hover {
        opacity: 1;
    }
    .mp-card-hover span {
        color: #fff;
        font-family: 'Inter', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        border: 1px solid #fff;
        padding: 10px 20px;
        font-size: 0.8rem;
    }

    @media (max-width: 768px) {
        .mp-masonry-group {
            grid-template-columns: 1fr;
        }
        .mp-masonry-large {
            min-height: 400px;
            grid-row: span 1;
        }
        .mp-masonry-small {
            min-height: 300px;
        }
    }

    /* Hero Styles */
    .mp-hero-text {
        position: relative;
        z-index: 2;
        color: #fff;
        max-width: 620px;
        text-align: left;
    }
    .mp-hero-eyebrow {
        display: block;
        font-size: 0.7rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        opacity: 0.85;
        margin-bottom: 12px;
    }
    .mp-hero-brand {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3rem, 8vw, 5.5rem);
        font-weight: 400;
        font-style: italic;
        line-height: 1;
        margin-bottom: 20px;
        color: #fff;
        letter-spacing: -2px;
    }
    .mp-hero-sub {
        font-size: 0.95rem;
        font-weight: 300;
        opacity: 0.9;
        margin-bottom: 40px;
        line-height: 1.7;
        max-width: 420px;
    }
    .mp-hero-actions {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    .mp-btn-white {
        display: inline-block;
        background: #fff;
        color: #000;
        padding: 16px 40px;
        border-radius: 0;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .mp-btn-white:hover {
        background: #000;
        color: #fff;
        transform: translateY(-3px);
    }
    .mp-btn-outline {
        display: inline-block;
        background: transparent;
        color: #fff;
        border: 1px solid rgba(255,255,255,0.6);
        padding: 16px 40px;
        border-radius: 0;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .mp-btn-outline:hover {
        background: rgba(255,255,255,0.15);
        border-color: #fff;
        transform: translateY(-3px);
    }

    /* CTA Styles */
    .mp-cta {
        position: relative;
        height: 550px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
    }
    .mp-cta-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.6);
    }
    .mp-cta-content {
        position: relative;
        z-index: 2;
        color: #fff;
        max-width: 600px;
        padding: 0 20px;
    }
    .mp-cta-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 5vw, 3.8rem);
        font-weight: 400;
        margin-bottom: 20px;
        color: #fff;
        line-height: 1.1;
    }
    .mp-cta-content p {
        font-size: 1rem;
        opacity: 0.85;
        margin-bottom: 40px;
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .mp-hero-text {
            text-align: center;
            padding: 0 20px;
        }
        .mp-hero-actions {
            justify-content: center;
        }
        .mp-hero-brand {
            font-size: 3.5rem;
        }
    }

    /* Lightbox Styles */
    .mp-lightbox {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.93);
        z-index: 3000;
        align-items: center;
        justify-content: center;
    }
    .mp-lightbox.active {
        display: flex;
    }
    .mp-lb-img-wrap img {
        max-width: 88vw;
        max-height: 88vh;
        object-fit: contain;
        display: block;
        border-radius: 2px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.6);
    }
    .mp-lb-close {
        position: absolute;
        top: 20px; right: 24px;
        color: #fff;
        font-size: 2.5rem;
        background: none;
        border: none;
        cursor: pointer;
        opacity: 0.6;
        line-height: 1;
        transition: opacity 0.2s ease, transform 0.2s ease;
        z-index: 3001;
    }
    .mp-lb-close:hover { opacity: 1; transform: rotate(90deg); }
    .mp-lb-prev, .mp-lb-next {
        position: absolute;
        top: 50%; transform: translateY(-50%);
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        font-size: 1.2rem;
        width: 52px; height: 52px;
        border-radius: 50%;
        cursor: pointer;
        transition: background 0.25s ease;
        z-index: 3001;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .mp-lb-prev:hover, .mp-lb-next:hover { background: rgba(255,255,255,0.25); }
    .mp-lb-prev { left: 24px; }
    .mp-lb-next { right: 24px; }

  </style>
</head>
<body class="mp-body">

{{-- NAV --}}
<header id="mp-header">
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

  <!-- 2. Wedding Dresses -->
  <section id="wedding-dresses" class="py-20 bg-white reveal-on-scroll text-center">
    <div class="max-w-7xl mx-auto px-4">
      <span class="mp-hero-eyebrow" style="color: #888; margin-bottom: 15px;">Bridal</span>
      <div style="display: inline-flex; align-items: center; gap: 30px; margin-bottom: 20px;">
        <div style="width: 60px; height: 5px; background-color: #c5a48e; opacity: 0.8;"></div>
        <h3 class="gallery-heading" style="margin-bottom: 0;">Wedding Dresses</h3>
      </div>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-12">Timeless elegance for your walk down the aisle.</p>
      <div id="gallery-wedding" class="mt-8"></div>
    </div>
  </section>

  <!-- 3. Evening Gowns -->
  <section id="evening-gowns" class="py-20 reveal-on-scroll text-center" style="background-color: #faf9f6;">
    <div class="max-w-7xl mx-auto px-4">
      <span class="mp-hero-eyebrow" style="color: #888; margin-bottom: 15px;">Couture</span>
      <div style="display: inline-flex; align-items: center; gap: 30px; margin-bottom: 20px;">
        <div style="width: 60px; height: 5px; background-color: #c5a48e; opacity: 0.8;"></div>
        <h3 class="gallery-heading" style="margin-bottom: 0;">Evening Gowns</h3>
      </div>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-12">Sophisticated glamour for life's most grand occasions.</p>
      <div id="gallery-evening" class="mt-8"></div>
    </div>
  </section>

  <!-- 5. Filipiniana -->
  <section id="filipiniana" class="py-20 reveal-on-scroll text-center" style="background-color: #faf9f6;">
    <div class="max-w-7xl mx-auto px-4">
      <span class="mp-hero-eyebrow" style="color: #888; margin-bottom: 15px;">Heritage</span>
      <div style="display: inline-flex; align-items: center; gap: 30px; margin-bottom: 20px;">
        <div style="width: 60px; height: 5px; background-color: #c5a48e; opacity: 0.8;"></div>
        <h3 class="gallery-heading" style="margin-bottom: 0;">Filipiniana</h3>
      </div>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-12">Celebrating the timeless beauty of Filipino heritage through couture craftsmanship.</p>
      <div id="gallery-filipiniana" class="mt-8"></div>
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
      <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-12">Celebrating the timeless beauty of Filipino heritage through couture craftsmanship.</p>
      <div id="gallery-filipiniana" class="mt-8"></div>
    </div>
  </div>
</main>

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