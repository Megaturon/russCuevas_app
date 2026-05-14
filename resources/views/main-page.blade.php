<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Russ Cuevas Atelier — Bespoke couture crafted for life's most important moments.">
  <title>Russ Cuevas Atelier</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  @vite(['resources/css/styles2.css'])
</head>
<body class="mp-body">

{{-- NAV --}}
<header id="mp-header">
  <x-nav-bar></x-nav-bar>
</header>

{{-- ===== HERO ===== --}}
<section class="mp-hero" id="mp-hero"
  data-slides='["/images/slide1.jpg","/images/slide2.webp","/images/slide3.jpg"]'>

  <div class="mp-hero-text">
    <span class="mp-hero-eyebrow">Est. Manila &middot; Bespoke Couture</span>
    <h1 class="mp-hero-brand">Russ Cuevas</h1>
    <p class="mp-hero-sub">Quality craftsmanship tailored to your most important moments.</p>
    <div class="mp-hero-actions">
      <a href="{{ route('appointments.index') }}" class="mp-btn-white" id="book-appointment">Book an Appointment</a>
      <a href="#mp-collections" class="mp-btn-outline">View Collections</a>
    </div>
  </div>

  <ul class="mp-hero-dots" id="mp-dots">
    <li class="active"></li>
    <li></li>
    <li></li>
  </ul>
</section>



{{-- ===== COLLECTIONS GALLERY ===== --}}
<section class="mp-collections" id="mp-collections">
  <div class="mp-collections-header">
    <h2 class="mp-section-label">Collections</h2>
    <div class="mp-collection-tabs" id="mp-tabs">
      <button class="mp-tab active" data-cat="Wedding Gown">Wedding Gown</button>
      <button class="mp-tab" data-cat="Principal Sponsor">Principal Sponsor</button>
      <button class="mp-tab" data-cat="Evening Gown">Evening Gown</button>
      <button class="mp-tab" data-cat="Formal Wear">Formal Wear</button>
      <button class="mp-tab" data-cat="Prom">Prom</button>
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
  </section>

{{-- ===== LIGHTBOX ===== --}}
<div id="mp-lightbox" class="mp-lightbox" role="dialog" aria-modal="true">
  <button class="mp-lb-close" onclick="mpCloseLb()" aria-label="Close">&times;</button>
  <button class="mp-lb-prev" onclick="mpPrevLb()" aria-label="Previous">&#10094;</button>
  <button class="mp-lb-next" onclick="mpNextLb()" aria-label="Next">&#10095;</button>
  <div class="mp-lb-img-wrap"><img id="mp-lb-img" src="" alt="Gallery"></div>
</div>

<script>
/* ============================================================
   GALLERY DATA
============================================================ */
var mpGallery = {
  "Wedding Gown": [
    { thumb: "/images/wedding dress.jpg", imgs: ["/images/a1.jpg","/images/a2.jpg","/images/wedding dress.jpg"] },
    { thumb: "/images/wed2.jpg",          imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] },
    { thumb: "/images/3.jpg",             imgs: ["/images/3.jpg","/images/4.jpg","/images/5.jpg"] },
    { thumb: "/images/3.jpg",             imgs: ["/images/3.jpg","/images/4.jpg","/images/5.jpg"] }
  ],
  "Principal Sponsor": [
    { thumb: "/images/3.jpg",    imgs: ["/images/3.jpg","/images/4.jpg","/images/5.jpg"] },
    { thumb: "/images/wed2.jpg", imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] },
    { thumb: "/images/wed2.jpg", imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] }
  ],
  "Evening Gown": [
    { thumb: "/images/3.jpg",    imgs: ["/images/3.jpg","/images/4.jpg","/images/5.jpg"] },
    { thumb: "/images/wed2.jpg", imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] },
    { thumb: "/images/wed2.jpg", imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] }
  ],
  "Formal Wear": [
    { thumb: "/images/3.jpg",    imgs: ["/images/3.jpg","/images/4.jpg","/images/5.jpg"] },
    { thumb: "/images/wed2.jpg", imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] },
    { thumb: "/images/wed2.jpg", imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] }
  ],
  "Prom": [
    { thumb: "/images/3.jpg",    imgs: ["/images/3.jpg","/images/4.jpg","/images/5.jpg"] },
    { thumb: "/images/wed2.jpg", imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] },
    { thumb: "/images/wed2.jpg", imgs: ["/images/aweb2.jpg","/images/aweb3.jpg","/images/aweb2.jpg"] }
  ]
};

/* ============================================================
   HERO SLIDER — background-image swap
============================================================ */
(function(){
  var hero   = document.getElementById('mp-hero');
  var dots   = document.querySelectorAll('#mp-dots li');
  var slides = JSON.parse(hero.dataset.slides);
  var idx    = 0;

  function setSlide(i) {
    dots[idx].classList.remove('active');
    idx = (i + slides.length) % slides.length;
    hero.style.backgroundImage = 'url("' + slides[idx] + '")';
    dots[idx].classList.add('active');
  }

  setSlide(0);

  dots.forEach(function(dot, i){
    dot.addEventListener('click', function(){
      clearInterval(timer);
      setSlide(i);
      timer = setInterval(auto, 5500);
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

/* ============================================================
   SMOOTH SCROLL for View Collections anchor
============================================================ */
document.querySelectorAll('a[href="#mp-collections"]').forEach(function(a){
  a.addEventListener('click', function(e){
    e.preventDefault();
    var target = document.getElementById('mp-collections');
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

/* ============================================================
   HEADER SCROLL SHADOW
============================================================ */
window.addEventListener('scroll', function(){
  document.getElementById('mp-header').classList.toggle('scrolled', window.scrollY > 50);
}, { passive: true });

/* ============================================================
   BOOT GALLERY
============================================================ */
@if($gallery == "wedding")
  document.querySelector('[data-cat="Wedding Gown"]').click();
@elseif($gallery == "sponsor")
  document.querySelector('[data-cat="Principal Sponsor"]').click();
@elseif($gallery == "evening")
  document.querySelector('[data-cat="Evening Gown"]').click();
@elseif($gallery == "formal")
  document.querySelector('[data-cat="Formal Wear"]').click();
@elseif($gallery == "prom")
  document.querySelector('[data-cat="Prom"]').click();
@else
  mpRenderGrid('Wedding Gown');
@endif
</script>
</body>
</html>