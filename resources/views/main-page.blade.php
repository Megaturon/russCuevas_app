<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Russ Cuevas</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    .swiper-slide {
        width: auto !important; /* Variable width */
        margin-right: 20px;
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
  <section id="gallery-section" class="py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center reveal-on-scroll">
    <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mb-6">Gallery</h2>
    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">Explore our exquisite collection of meticulously crafted gowns, designed to make your special moments unforgettable. From timeless wedding dresses to elegant evening wear and stunning prom creations, each piece tells a unique story.</p>
  </section>

  <!-- 2. Wedding Dresses -->
  <section id="wedding-dresses" class="py-16 bg-white reveal-on-scroll">
    <div class="max-w-[100vw] overflow-hidden">
      <h3 class="text-3xl font-serif font-semibold text-gray-800 mb-10 text-center">Wedding Dresses</h3>
      <div class="swiper gallerySwiper w-full px-4 sm:px-10">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="/images/wedding_closeup.jpg" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress-2.jpg" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress-2.png" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress-3.jpg" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress-3.png" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress-4.jpg" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress-4.png" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress-5.jpg" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress.jpeg" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress.jpg" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/wedding_dress.png" alt="Wedding Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. Evening Gowns -->
  <section id="evening-gowns" class="py-16 bg-[#faf9f6] reveal-on-scroll">
    <div class="max-w-[100vw] overflow-hidden">
      <h3 class="text-3xl font-serif font-semibold text-gray-800 mb-10 text-center">Evening Gowns</h3>
      <div class="swiper gallerySwiper w-full px-4 sm:px-10">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="/images/4.jpg" alt="Evening Gown" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/evening-2.jpg" alt="Evening Gown" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/evening-3.jpg" alt="Evening Gown" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/evening-4.jpg" alt="Evening Gown" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/evening.jpg" alt="Evening Gown" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. Prom Dresses -->
  <section id="prom-dresses" class="py-16 bg-white reveal-on-scroll">
    <div class="max-w-[100vw] overflow-hidden">
      <h3 class="text-3xl font-serif font-semibold text-gray-800 mb-10 text-center">Prom Collections</h3>
      <div class="swiper gallerySwiper w-full px-4 sm:px-10">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="/images/prom-2.jpg" alt="Prom Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/prom-3.jpg" alt="Prom Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/prom-4.jpg" alt="Prom Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
          <div class="swiper-slide"><img src="/images/prom.jpg" alt="Prom Dress" class="h-[60vh] md:h-[75vh] w-auto object-cover rounded-md shadow-lg"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. CTA Button -->
  <section id="cta-section" class="py-24 bg-white text-center reveal-on-scroll">
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

  // Scroll Reveal Logic
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

      // Initialize Swiper Carousels
      const swipers = document.querySelectorAll('.gallerySwiper');
      swipers.forEach(function(swiperElement) {
        new Swiper(swiperElement, {
          slidesPerView: 'auto',
          spaceBetween: 20,
          freeMode: true,
          autoplay: {
            delay: 3000,
            disableOnInteraction: false,
          },
        });
      });
  });
</script>

</body>
</html>