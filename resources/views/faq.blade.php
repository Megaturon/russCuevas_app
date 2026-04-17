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

<main class="pt-24 pb-12 px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center">
        <div class="w-full max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <h1 class="text-4xl font-bold text-center text-gray-900 mb-10 font-serif">Frequently Asked Questions</h1>
            
            <div class="space-y-4">
                <div class="faq-item border border-gray-200 rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md overflow-hidden">
                    <button class="faq-button w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">How do I book an appointment?</span>
                        <svg class="faq-icon w-6 h-6 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                        <p>You can book an appointment by navigating to our "Book Appointment" page and selecting a date and time that works for you.</p>
                    </div>
                </div>

                <div class="faq-item border border-gray-200 rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md overflow-hidden">
                    <button class="faq-button w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">Do you offer custom tailoring?</span>
                        <svg class="faq-icon w-6 h-6 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                        <p>Yes, we specialize in custom tailoring for wedding gowns, evening gowns, and formal wear. Use our "Get a Quote" page for a personalized estimate.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
	
    <script>
// Interactive Accordion Logic
        const faqItems = document.querySelectorAll('.faq-item');
    
        faqItems.forEach(item => {
            const button = item.querySelector('.faq-button');
            const answer = item.querySelector('.faq-answer');
            const icon = item.querySelector('.faq-icon');

            button.addEventListener('click', () => {
                // Close all other open FAQs
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.querySelector('.faq-answer').classList.add('hidden');
                        otherItem.querySelector('.faq-icon').classList.remove('rotate-180');
                    }
                });

                // Toggle the clicked FAQ
                answer.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });
    </script>
</body>
</html>