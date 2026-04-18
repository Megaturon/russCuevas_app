<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Russ Cuevas Artelier</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style2.css') }}">
</head>
<body>
    <header>
        <x-nav-bar></x-nav-bar>
    </header>

    <main class="quote-page">
        <div class="quote-container" style="max-width: 800px; margin: 0 auto;">
            <h1 class="page-title" style="font-size: 3rem; text-align: center; margin-bottom: 2rem;">Frequently Asked Questions</h1>
            
            <div class="faq-item">
                <h2>How do I book an appointment?</h2>
                <p>You can book an appointment by navigating to our "Book Appointment" page and selecting a date and time that works for you.</p>
            </div>

            <div class="faq-item">
                <h2>Do you offer custom tailoring?</h2>
                <p>Yes, we specialize in custom tailoring for wedding gowns, evening gowns, and formal wear. Use our "Get a Quote" page for a personalized estimate.</p>
            </div>
        </div>
    </main>
	
    <script>
        // FAQ Toggle Logic
        const faqItems = document.querySelectorAll('.faq-item');
    
        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                faqItems.forEach(i => {
                    if (i !== item) i.classList.remove('open');
                });
                item.classList.toggle('open');
            });
        });
    </script>
</body>
</html>