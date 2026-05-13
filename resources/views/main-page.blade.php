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
  </div>
  <div class="mp-grid" id="mp-grid">
    {{-- filled by JS --}}
  </div>
</section>

{{-- ===== SERVICES LIST ===== --}}
<section class="mp-catlist">
  <h2 class="mp-section-label">Services</h2>
  <ul class="mp-catlist-items">
    <li><a href="{{ route('appointments.index') }}"><span>Bespoke Gown Design</span><i class="fa-solid fa-arrow-right"></i></a></li>
    <li><a href="{{ route('appointments.index') }}"><span>Wedding Couture</span><i class="fa-solid fa-arrow-right"></i></a></li>
    <li><a href="{{ route('appointments.index') }}"><span>Evening &amp; Formal Wear</span><i class="fa-solid fa-arrow-right"></i></a></li>
    <li><a href="{{ route('appointments.index') }}"><span>Prom &amp; Debut Gowns</span><i class="fa-solid fa-arrow-right"></i></a></li>
    <li><a href="{{ route('quote.index') }}"><span>Get a Quote</span><i class="fa-solid fa-arrow-right"></i></a></li>
  </ul>
</section>

{{-- ===== CTA BANNER ===== --}}
<section class="mp-cta" style="background-image:url('/images/slide3.jpg')">
  <div class="mp-cta-overlay"></div>
  <div class="mp-cta-content">
    <span class="mp-hero-eyebrow" style="color:rgba(255,255,255,0.65)">Begin Your Journey</span>
    <h2>Your Dream Gown Awaits</h2>
    <p>Schedule a personal consultation and bring your vision to life.</p>
    <a href="{{ route('appointments.index') }}" class="mp-btn-white">Book a Consultation</a>
  </div>
</section>

{{-- ===== FOOTER ===== --}}
<footer class="mp-footer" id="contact">
  <div class="mp-footer-top">
    <div class="mp-footer-brand">
      <img src="/images/RC_logo.jpg" alt="Russ Cuevas Logo" class="mp-footer-logo">
      <p>Bespoke couture crafted for life's most meaningful moments.<br>Based in Manila, Philippines.</p>
      <div class="mp-footer-socials">
        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
      </div>
    </div>
    <div class="mp-footer-col">
      <h4>Collections</h4>
      <ul>
        <li><a href="#mp-collections">Wedding Gown</a></li>
        <li><a href="#mp-collections">Evening Gown</a></li>
        <li><a href="#mp-collections">Prom</a></li>
        <li><a href="#mp-collections">Formal Wear</a></li>
        <li><a href="#mp-collections">Principal Sponsor</a></li>
      </ul>
    </div>
    <div class="mp-footer-col">
      <h4>Navigate</h4>
      <ul>
        <li><a href="{{ route('appointments.index') }}">Book Appointment</a></li>
        <li><a href="{{ route('quote.index') }}">Get a Quote</a></li>
        <li><a href="/our-story">Our Story</a></li>
        <li><a href="/faq">FAQ</a></li>
        <li><a href="/terms">Terms &amp; Conditions</a></li>
      </ul>
    </div>
    <div class="mp-footer-col">
      <h4>Contact</h4>
      <ul class="mp-footer-contact">
        <li><i class="fa-solid fa-location-dot"></i> Manila, Philippines</li>
        <li><i class="fa-solid fa-phone"></i> +63 XXX XXX XXXX</li>
        <li><i class="fa-solid fa-envelope"></i> hello@russcuevas.com</li>
        <li><i class="fa-solid fa-clock"></i> Mon&ndash;Sat, 9AM&ndash;6PM</li>
      </ul>
    </div>
  </div>
  <div class="mp-footer-bottom">
    <p>&copy; {{ date('Y') }} Russ Cuevas Atelier. All rights reserved.</p>
    <div>
      <a href="/terms">Privacy Policy</a>
      <a href="/terms">Terms of Service</a>
    </div>
  </div>
</footer>

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

  function auto(){ setSlide(idx + 1); }
  var timer = setInterval(auto, 5500);
})();

/* ============================================================
   GALLERY TABS + GRID
============================================================ */
var mpLbImages = [];
var mpLbIdx    = 0;

function mpRenderGrid(cat) {
  var grid  = document.getElementById('mp-grid');
  var items = mpGallery[cat] || [];
  grid.innerHTML = '';
  items.forEach(function(item, i){
    var card = document.createElement('div');
    card.className = 'mp-card';
    card.innerHTML =
      '<div class="mp-card-img" style="background-image:url(\'' + item.thumb + '\')">' +
        '<div class="mp-card-hover"><span>View</span></div>' +
      '</div>' +
      '<p class="mp-card-label">' + cat + '</p>';
    card.querySelector('.mp-card-img').addEventListener('click', function(){
      mpOpenLb(item.imgs, 0);
    });
    grid.appendChild(card);
  });
}

document.querySelectorAll('.mp-tab').forEach(function(tab){
  tab.addEventListener('click', function(){
    document.querySelectorAll('.mp-tab').forEach(function(t){ t.classList.remove('active'); });
    tab.classList.add('active');
    mpRenderGrid(tab.dataset.cat);
  });
});

/* ============================================================
   LIGHTBOX
============================================================ */
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