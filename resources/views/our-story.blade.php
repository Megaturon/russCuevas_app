<html>
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Our Story - Russ Cuevas Atelier</title>

  @vite(['resources/css/styles2.css', 'resources/css/our-story.css', 'resources/js/app.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('style2.css') }}">
</head>
<body>

<header>
  <x-nav-bar></x-nav-bar>
</header>

<main>
    <div class="story-header" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/img/our_story_2.png') center/cover no-repeat;">
        <h1>The Atelier Story</h1>
    </div>

    <div class="story-content">
        <!-- Section 1 -->
        <div class="story-section">
            <div class="story-text reveal-on-scroll">
                <h2>A Legacy of Elegance</h2>
                <p>Welcome to Russ Cuevas, where dreams are woven into reality. Our journey began with a simple yet profound vision: to craft garments that not only fit perfectly but tell a uniquely beautiful story.</p>
                <p>Every piece in our atelier is born from passion and an unwavering dedication to the art of haute couture. We believe that true luxury lies in the details—the quiet perfection of a hand-stitched seam, the delicate drape of premium silk, and the thoughtful silhouette designed just for you.</p>
            </div>
            <div class="story-image-container reveal-on-scroll">
                <img src="/img/our_story_2.png" alt="Fashion sketches in atelier">
            </div>
        </div>

        <div class="pride-banner reveal-on-scroll">
            <h3>Craftsmanship is Our Signature</h3>
            <p>"We don't just make dresses; we craft unforgettable moments. Our pride is sewn into every fabric, and our reward is the confidence you wear. To us, every stitch is a promise of perfection."</p>
        </div>

        <!-- Section 2 -->
        <div class="story-section">
            <div class="story-image-container reveal-on-scroll">
                <img src="/img/our_story_1.png" alt="Artisan stitching luxury fabric">
            </div>
            <div class="story-text reveal-on-scroll">
                <h2>The Art of Creation</h2>
                <p>In our studio, time slows down. We reject the rush of modern fashion in favor of meticulous, traditional tailoring. From the initial conceptual sketch to the final fitting, every step is an intimate collaboration between artisan and client.</p>
                <p>We pour our hearts into selecting the finest materials from around the world, transforming them through hours of dedicated handwork. When you step out in a Russ Cuevas creation, you carry the pride of masterful craftsmanship.</p>
            </div>
        </div>
    </div>
    <x-chatbot />
    <x-footer></x-footer>
</main>

<script>
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
        revealOnScroll(); // Trigger immediately for elements already in view
    });
</script>

</body>
</html>


