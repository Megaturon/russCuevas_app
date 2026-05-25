<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Russ Cuevas Artelier</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/styles2.css'])
</head>
<body>
    <header>
        <x-nav-bar></x-nav-bar>
    </header>

<main class="flex-grow pt-24 pb-12 px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8 md:p-12 mt-8">
            <h1 class="text-4xl font-bold text-center text-gray-900 mb-10 font-serif">Frequently Asked Questions</h1>
            
            <div class="space-y-4">
                <div class="faq-item border border-gray-200 rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md overflow-hidden">
                    <button class="faq-button w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">Do you accept custom orders for RTW styles?</span>
                        <svg class="faq-icon w-6 h-6 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer overflow-hidden transition-all duration-400 ease-in-out opacity-0" style="max-height: 0px;">
                        <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                            <p>Yes, we do! Please email us at <a href="mailto:cuevas.russ01@gmail.com" class="text-blue-600 hover:underline">cuevas.russ01@gmail.com</a> for more information.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item border border-gray-200 rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md overflow-hidden">
                    <button class="faq-button w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">How do I place a custom order?</span>
                        <svg class="faq-icon w-6 h-6 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer overflow-hidden transition-all duration-400 ease-in-out opacity-0" style="max-height: 0px;">
                        <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                            <p>You can place a custom order by booking a consultation with us.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item border border-gray-200 rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md overflow-hidden">
                    <button class="faq-button w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">Are consultations in-person or virtual?</span>
                        <svg class="faq-icon w-6 h-6 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer overflow-hidden transition-all duration-400 ease-in-out opacity-0" style="max-height: 0px;">
                        <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                            <p>We offer both in-person and virtual consultations depending on your preference.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item border border-gray-200 rounded-xl bg-white shadow-sm transition-all duration-200 hover:shadow-md overflow-hidden">
                    <button class="faq-button w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">Where are your stores located?</span>
                        <svg class="faq-icon w-6 h-6 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer overflow-hidden transition-all duration-400 ease-in-out opacity-0" style="max-height: 0px;">
                        <div class="px-6 pb-6 text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                            <p>We have a store located in Russ Cuevas Couture Kalawaan, Pasig City, Metro Manila, 1600, NCR, Philippines.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	
    <x-footer></x-footer>
	
    <script>
        // FAQ Toggle Logic
        const faqItems = document.querySelectorAll('.faq-item');
    
        faqItems.forEach(item => {
            const button = item.querySelector('.faq-button');
            const answer = item.querySelector('.faq-answer');
            const icon = item.querySelector('.faq-icon');

            // Apply transition styles dynamically in JS to ensure smooth height changes
            answer.style.transition = 'max-height 0.4s ease-in-out, opacity 0.4s ease-in-out';

            button.addEventListener('click', () => {
                const isOpen = answer.style.maxHeight !== '0px';

                // Close all other items
                faqItems.forEach(otherItem => {
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    const otherIcon = otherItem.querySelector('.faq-icon');
                    if (otherItem !== item) {
                        otherAnswer.style.maxHeight = '0px';
                        otherAnswer.style.opacity = '0';
                        otherIcon.classList.remove('rotate-180');
                    }
                });

                if (!isOpen) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    answer.style.opacity = '1';
                    icon.classList.add('rotate-180');
                } else {
                    answer.style.maxHeight = '0px';
                    answer.style.opacity = '0';
                    icon.classList.remove('rotate-180');
                }
            });
        });
    </script>
</body>
</html>
