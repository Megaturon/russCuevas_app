<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Russ Cuevas</title>

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  @vite(['resources/css/styles2.css'])
  <style>
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

  </style>
</head>

<body>
<header>
  <x-nav-bar></x-nav-bar>
</header>

<main class="home">

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
          <button class="book-btn" id="book-appointment" onclick="window.location.href='/appointments'">
            Book an Appointment
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- 1. Gallery Title and Description -->
  <section id="gallery-section" class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center reveal-on-scroll">
    <h2 class="gallery-heading" style="font-size: 4rem;">Gallery</h2>
    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">Explore our exquisite collection of meticulously crafted gowns, designed to make your special moments unforgettable. From timeless wedding dresses to elegant evening wear and stunning prom creations, each piece tells a unique story.</p>
  </section>

  <!-- 2. Wedding Dresses -->
  <section id="wedding-dresses" class="py-16 bg-white reveal-on-scroll">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="gallery-heading">Wedding Dresses</h3>
      <div id="gallery-wedding" class="mt-12"></div>
    </div>
  </section>

  <!-- 3. Evening Gowns -->
  <section id="evening-gowns" class="py-16 reveal-on-scroll" style="background-color: #faf9f6;">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="gallery-heading">Evening Gowns</h3>
      <div id="gallery-evening" class="mt-12"></div>
    </div>
  </section>

  <!-- 4. Prom Dresses -->
  <section id="prom-dresses" class="py-16 bg-white reveal-on-scroll">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="gallery-heading">Prom Collections</h3>
      <div id="gallery-prom" class="mt-12"></div>
    </div>
  </section>

  {{-- ===== LIGHTBOX ===== --}}
  <div id="mp-lightbox" class="mp-lightbox" role="dialog" aria-modal="true">
    <button class="mp-lb-close" onclick="mpCloseLb()" aria-label="Close">&times;</button>
    <button class="mp-lb-prev" onclick="mpPrevLb()" aria-label="Previous">&#10094;</button>
    <button class="mp-lb-next" onclick="mpNextLb()" aria-label="Next">&#10095;</button>
    <div class="mp-lb-img-wrap"><img id="mp-lb-img" src="" alt="Gallery"></div>
  </div>


  <!-- 5. CTA Button -->
  <section id="cta-section" class="py-16 bg-white text-center reveal-on-scroll">
    <div class="max-w-4xl mx-auto px-4">
      <h2 class="text-4xl font-serif font-bold text-gray-900 mb-6">Ready to Find Your Dream Dress?</h2>
      <p class="text-lg text-gray-600 mb-10">Book an appointment with Russ Cuevas Atelier and let us create a masterpiece tailored perfectly to you.</p>
      <button class="book-btn" onclick="window.location.href='/appointments'">
        Book an Appointment
      </button>
    </div>
  </section>
</main>

<x-footer></x-footer>

<!-- Scripts -->
<script>
  // Main slider initialization
  let slider = document.querySelector('.slider .list');
  let items = document.querySelectorAll('.slider .list .item');
  let dots = document.querySelectorAll('.slider .dots li');
  let active = 0;
  let lengthItems = items.length - 1;

  function reloadSlider() {
    items.forEach(item => item.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    items[active].classList.add('active');
    dots[active].classList.add('active');
    slider.style.left = `-${active * 100}vw`;
  }

  let autoSlide = setInterval(() => {
    active = active >= lengthItems ? 0 : active + 1;
    reloadSlider();
  }, 5000);

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

  reloadSlider();

  // Gallery Data
  var mpGallery = {
    "Wedding": [
      { thumb: "/images/wedding_closeup.jpg", imgs: ["/images/wedding_closeup.jpg"] },
      { thumb: "/images/wedding_dress-2.jpg", imgs: ["/images/wedding_dress-2.jpg"] },
      { thumb: "/images/wedding_dress-3.jpg", imgs: ["/images/wedding_dress-3.jpg"] },
      { thumb: "/images/wedding_dress-4.jpg", imgs: ["/images/wedding_dress-4.jpg"] },
      { thumb: "/images/wedding_dress-5.jpg", imgs: ["/images/wedding_dress-5.jpg"] },
      { thumb: "/images/wedding_dress.jpg",   imgs: ["/images/wedding_dress.jpg"] }
    ],
    "Evening": [
      { thumb: "/images/4.jpg",          imgs: ["/images/4.jpg"] },
      { thumb: "/images/evening-2.jpg",  imgs: ["/images/evening-2.jpg"] },
      { thumb: "/images/evening-3.jpg",  imgs: ["/images/evening-3.jpg"] },
      { thumb: "/images/evening-4.jpg",  imgs: ["/images/evening-4.jpg"] },
      { thumb: "/images/evening.jpg",    imgs: ["/images/evening.jpg"] },
      { thumb: "/images/4.jpg",          imgs: ["/images/4.jpg"] }
    ],
    "Prom": [
      { thumb: "/images/prom-2.jpg", imgs: ["/images/prom-2.jpg"] },
      { thumb: "/images/prom-3.jpg", imgs: ["/images/prom-3.jpg"] },
      { thumb: "/images/prom-4.jpg", imgs: ["/images/prom-4.jpg"] },
      { thumb: "/images/prom.jpg",   imgs: ["/images/prom.jpg"] },
      { thumb: "/images/prom-2.jpg", imgs: ["/images/prom-2.jpg"] },
      { thumb: "/images/prom-3.jpg", imgs: ["/images/prom-3.jpg"] }
    ]
  };

  var mpLbImages = [];
  var mpLbIdx    = 0;

  function mpRenderMasonry(containerId, cat) {
    var container = document.getElementById(containerId);
    var items = mpGallery[cat] || [];
    if (!container) return;
    
    var html = '';
    for (var i = 0; i < items.length; i += 3) {
      var chunk = items.slice(i, i + 3);
      var isFlipped = (i / 3) % 2 === 1;
      
      html += '<div class="mp-masonry-group">';
      
      var largeHtml = '';
      if (chunk[0]) {
        largeHtml = '<div class="mp-masonry-large" onclick="mpOpenLbCategory(\'' + cat + '\', ' + i + ')" style="background-image:url(\'' + chunk[0].thumb + '\')"><div class="mp-card-hover"><span>View</span></div></div>';
      }
      
      var smallHtml = '';
      if (chunk[1] || chunk[2]) {
        smallHtml += '<div class="mp-masonry-small-col">';
        if (chunk[1]) {
          smallHtml += '<div class="mp-masonry-small" onclick="mpOpenLbCategory(\'' + cat + '\', ' + (i+1) + ')" style="background-image:url(\'' + chunk[1].thumb + '\')"><div class="mp-card-hover"><span>View</span></div></div>';
        }
        if (chunk[2]) {
          smallHtml += '<div class="mp-masonry-small" onclick="mpOpenLbCategory(\'' + cat + '\', ' + (i+2) + ')" style="background-image:url(\'' + chunk[2].thumb + '\')"><div class="mp-card-hover"><span>View</span></div></div>';
        }
        smallHtml += '</div>';
      }

      html += isFlipped ? (smallHtml + largeHtml) : (largeHtml + smallHtml);
      html += '</div>';
    }
    container.innerHTML = html;
  }

  function mpOpenLbCategory(cat, i){
    var item = mpGallery[cat][i];
    if(item && item.imgs) mpOpenLb(item.imgs, 0);
  }

  function mpOpenLb(imgs, i){
    mpLbImages = imgs;
    mpLbIdx    = i;
    document.getElementById('mp-lb-img').src = imgs[i];
    document.getElementById('mp-lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
  }
  function mpCloseLb(){
    document.getElementById('mp-lightbox').classList.remove('active');
    document.body.style.overflow = '';
  }
  function mpPrevLb(){
    mpLbIdx = (mpLbIdx - 1 + mpLbImages.length) % mpLbImages.length;
    document.getElementById('mp-lb-img').src = mpLbImages[mpLbIdx];
  }
  function mpNextLb(){
    mpLbIdx = (mpLbIdx + 1) % mpLbImages.length;
    document.getElementById('mp-lb-img').src = mpLbImages[mpLbIdx];
  }

  document.addEventListener("DOMContentLoaded", () => {
      const reveals = document.querySelectorAll(".reveal-on-scroll");
      const revealOnScroll = () => {
          for (let i = 0; i < reveals.length; i++) {
              const windowHeight = window.innerHeight;
              const elementTop = reveals[i].getBoundingClientRect().top;
              const elementVisible = 50;
              if (elementTop < windowHeight - elementVisible) {
                  reveals[i].classList.add("scrolled-in");
              }
          }
      };
      window.addEventListener("scroll", revealOnScroll);
      revealOnScroll();

      // Render Masonry Galleries
      mpRenderMasonry('gallery-wedding', 'Wedding');
      mpRenderMasonry('gallery-evening', 'Evening');
      mpRenderMasonry('gallery-prom', 'Prom');
  });

  document.getElementById('mp-lightbox').addEventListener('click', function(e){
    if (e.target === this) mpCloseLb();
  });
  document.addEventListener('keydown', function(e){
    if (!document.getElementById('mp-lightbox').classList.contains('active')) return;
    if (e.key === 'ArrowLeft')  mpPrevLb();
    if (e.key === 'ArrowRight') mpNextLb();
    if (e.key === 'Escape')     mpCloseLb();
  });

</script>

</body>
</html>