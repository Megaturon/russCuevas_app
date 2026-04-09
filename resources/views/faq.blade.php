<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/styles2.css'])
    <title>FAQ - Russ Cuevas Artelier</title>
    
    <!-- React, ReactDOM, and Babel Scripts -->
    <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <x-nav-bar></x-nav-bar>
    </header>
    <main class="quote-page">
        <div class="quote-container">
		<p>FAQ</p>
        </div>
    </main>
	
	<script>
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
