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

    <div class="home-overlay" style="justify-content: flex-start; padding-left: 8%;">
      <div class="mp-hero-text">
        <span class="mp-hero-eyebrow">Est. Manila &middot; Bespoke Couture</span>
        <h1 class="mp-hero-brand">Russ Cuevas</h1>
        <p class="mp-hero-sub">Quality craftsmanship tailored to your most important moments.</p>
        <div class="mp-hero-actions">
          <a href="{{ route('appointments.index') }}" class="mp-btn-white" id="book-appointment">Book an Appointment</a>
          <a href="#gallery-section" class="mp-btn-outline">View Collections</a>
        </div>
      </div>
    </div>

  </div>

  <!-- 1. Gallery Title and Description -->
  <section id="gallery-section" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center reveal-on-scroll">
    <span class="mp-hero-eyebrow" style="color: #888; margin-bottom: 15px;">Gallery</span>
    <div style="display: inline-flex; align-items: center; gap: 30px; margin-bottom: 25px;">
      <div style="width: 80px; height: 5px; background-color: #c5a48e; opacity: 0.8;"></div>
      <h2 class="gallery-heading" style="font-size: 4rem; margin-bottom: 0;">Trendy Looks for Every Occasion</h2>
    </div>
    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">Explore our exquisite collection of meticulously crafted gowns, designed to make your special moments unforgettable. From timeless wedding dresses to elegant evening wear and stunning prom creations, each piece tells a unique story.</p>
  </section>

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

  <!-- 4. Prom Dresses -->
  <section id="prom-dresses" class="py-20 bg-white reveal-on-scroll text-center">
    <div class="max-w-7xl mx-auto px-4">
      <span class="mp-hero-eyebrow" style="color: #888; margin-bottom: 15px;">Debut</span>
      <div style="display: inline-flex; align-items: center; gap: 30px; margin-bottom: 20px;">
        <div style="width: 60px; height: 5px; background-color: #c5a48e; opacity: 0.8;"></div>
        <h3 class="gallery-heading" style="margin-bottom: 0;">Prom Collections</h3>
      </div>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-12">Make a statement with youthful and modern couture.</p>
      <div id="gallery-prom" class="mt-8"></div>
    </div>
  </section>

  <!-- 5. Filipiniana -->
  <section id="filipiniana-section" class="py-20 reveal-on-scroll text-center" style="background-color: #faf9f6;">
    <div class="max-w-7xl mx-auto px-4">
      <span class="mp-hero-eyebrow" style="color: #888; margin-bottom: 15px;">Heritage</span>
      <div style="display: inline-flex; align-items: center; gap: 30px; margin-bottom: 20px;">
        <div style="width: 60px; height: 5px; background-color: #c5a48e; opacity: 0.8;"></div>
        <h3 class="gallery-heading" style="margin-bottom: 0;">Filipiniana Collection</h3>
      </div>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-12">Celebrating the timeless beauty of Filipino heritage through couture craftsmanship.</p>
      <div id="gallery-filipiniana" class="mt-8"></div>
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
  <section id="cta-section" class="mp-cta reveal-on-scroll" style="background-image: url('/images/slide3.jpg');">
    <div class="mp-cta-overlay"></div>
    <div class="mp-cta-content">
      <span class="mp-hero-eyebrow" style="color:rgba(255,255,255,0.7)">Begin Your Journey</span>
      <h2>Your Dream Gown Awaits</h2>
      <p>Schedule a personal consultation and bring your vision to life.</p>
      <a href="{{ route('appointments.index') }}" class="mp-btn-white">Book a Consultation</a>
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
    ],
    "Filipiniana": [
      { thumb: "/img/model2.jpg", imgs: ["/img/model2.jpg"] },
      { thumb: "/img/model3.jpg", imgs: ["/img/model3.jpg"] },
      { thumb: "/img/model4.jpg", imgs: ["/img/model4.jpg"] }
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
      mpRenderMasonry('gallery-filipiniana', 'Filipiniana');

      // Scroll to section if hash or gallery parameter exists
      const urlParams = new URLSearchParams(window.location.search);
      const galleryParam = urlParams.get('gallery');
      const hash = window.location.hash.substring(1);
      
      const targetId = galleryParam === 'wedding' ? 'wedding-dresses' :
                       galleryParam === 'evening' ? 'evening-gowns' :
                       galleryParam === 'prom' ? 'prom-dresses' : 
                       galleryParam === 'filipiniana' ? 'filipiniana-section' : hash;

      if (targetId) {
          setTimeout(() => {
              const el = document.getElementById(targetId);
              if (el) el.scrollIntoView({ behavior: 'smooth' });
          }, 500);
      }
  });

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