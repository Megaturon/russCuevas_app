<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Story - Russ Cuevas Atelier</title>

  @vite(['resources/css/styles2.css'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <style>
        .story-header {
            margin-top: 80px;
            height: 60vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/img/our_story_2.png') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }
        .story-header h1 {
            font-family: var(--font-serif);
            font-size: 4rem;
            font-style: italic;
            letter-spacing: 2px;
            animation: fadeInDown 1s ease forwards;
            opacity: 0;
            transform: translateY(-30px);
        }
        
        .story-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px;
        }

        .story-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            margin-bottom: 100px;
        }

        .story-section:nth-child(even) {
            direction: rtl;
        }
        
        .story-section:nth-child(even) .story-text {
            direction: ltr;
        }

        .story-text {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .story-text h2 {
            font-family: var(--font-serif);
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .story-text p {
            font-family: var(--font-sans);
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .story-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .story-image-container img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .story-image-container:hover img {
            transform: scale(1.03);
        }

        /* Scroll Animation Classes */
        .scrolled-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        @keyframes fadeInDown {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .story-section {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .story-section:nth-child(even) {
                direction: ltr;
            }
            .story-header h1 {
                font-size: 2.5rem;
            }
        }
        
        .pride-banner {
            text-align: center;
            padding: 80px 20px;
            background-color: var(--white-color);
            margin: 60px 0;
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1s ease, transform 1s ease;
            border-top: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
        }
        
        .pride-banner h3 {
            font-family: var(--font-serif);
            font-size: 2.2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        .pride-banner p {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 800px;
            margin: 0 auto;
            font-style: italic;
            line-height: 1.8;
        }
  </style>
</head>
<body>

<header>
  <x-nav-bar></x-nav-bar>
</header>

<main>
    <div class="story-header">
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
