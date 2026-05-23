<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get a Quote - Russ Cuevas Artelier</title>

    <!-- React, ReactDOM, and Babel Scripts -->
    <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Tailwind CSS (for React components) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @vite(['resources/css/styles2.css'])
</head>
<body>
<header>
    <x-nav-bar></x-nav-bar>
</header>

    <main class="quote-page">
        <div class="quote-container">
            <div class="quote-content">
                <h1>Get a Custom Quote</h1>
                <p>Fill out the form below and we'll get back to you with a personalized estimate.</p>
                


                        @if($errors->any())
                            <div class="elegant-alert elegant-alert-danger">
                                <i class="fas fa-exclamation-circle alert-icon"></i>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    <form id="quote-form" class="quote-form" action="{{ route('quote.store') }}" method="POST" enctype="multipart/form-data">
                        
                        @csrf 

                <div class="signup-grid">
                    <div class="form-group">
                        <label for="name">Full Name <span class="required-asterisk">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address <span class="required-asterisk">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="e.g. +1 (555) 000-0000" pattern="[0-9\s\-\+\(\)]*" title="Please enter a valid phone number" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                        <small style="color: var(--text-muted); font-size: 0.7rem; margin-top: 5px; display: block;">Optional. Formats accepted: numbers, spaces, dashes, plus, parentheses.</small>
                    </div>

                    <div class="form-group">
                        <label for="service-type">Service Type <span class="required-asterisk">*</span></label>
                        <select id="service-type" name="service-type" required style="border-bottom: 1px solid var(--border-light); background: transparent; padding: 12px 0; width: 100%;" onchange="toggleCustomService()">
                            <option value="">Select a Category</option>
                            <option value="Wedding Gown" {{ old('service-type') == 'Wedding Gown' ? 'selected' : '' }}>Wedding Gown</option>  
                            <option value="Bridesmaids" {{ old('service-type') == 'Bridesmaids' ? 'selected' : '' }}>Bridesmaids</option>
                            <option value="Evening Gown" {{ old('service-type') == 'Evening Gown' ? 'selected' : '' }}>Evening Gown</option>
                            <option value="Cocktail Dress" {{ old('service-type') == 'Cocktail Dress' ? 'selected' : '' }}>Cocktail Dress</option>
                            <option value="Prom Dress" {{ old('service-type') == 'Prom Dress' ? 'selected' : '' }}>Prom Dress</option>                          
                            <option value="other" {{ old('service-type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="custom-service-container" style="display: {{ old('service-type') == 'other' ? 'block' : 'none' }}; margin-top: 15px;">
                        <label for="custom_service_type">Please specify service <span class="required-asterisk">*</span></label>
                        <input type="text" id="custom_service_type" name="custom_service_type" placeholder="e.g. Alterations, Custom Suit" value="{{ old('custom_service_type') }}">
                    </div>

                </div>

                <div class="form-group">
                    <label>Select Preferred Materials</label>
                    <div id="materials-selection-root"></div>
                </div>

                <div class="form-group">
                    <div class="flex justify-between items-end mb-4">
                        <div style="flex: 1; max-width: 300px;">
                            <label for="size">Standard Size <span class="required-asterisk">*</span></label>
                            <select id="size" name="size" required style="border-bottom: 1px solid var(--border-light); background: transparent; padding: 12px 0; width: 100%;" onchange="toggleCustomSize()">
                                <option value="">Select your size</option>
                                <option value="36" {{ old('size') == '36' ? 'selected' : '' }}>EU 36 / US 4 / UK 8</option>
                                <option value="38" {{ old('size') == '38' ? 'selected' : '' }}>EU 38 / US 6 / UK 10</option>
                                <option value="40" {{ old('size') == '40' ? 'selected' : '' }}>EU 40 / US 8 / UK 12</option>
                                <option value="42" {{ old('size') == '42' ? 'selected' : '' }}>EU 42 / US 10 / UK 14</option>
                                <option value="custom" {{ old('size') == 'custom' ? 'selected' : '' }}>Custom Measurements</option>
                            </select>
                        </div>
                        <div class="size-guide-btn" id="openSizeGuide" style="margin-bottom: 12px;">
                            <i class="fas fa-ruler-combined"></i> View Size Guide
                        </div>
                    </div>
                </div>

                <div class="form-group" id="custom-size-container" style="display: {{ old('size') == 'custom' ? 'block' : 'none' }}; margin-top: 15px;">
                    <label for="custom_size">Custom Measurements <span class="required-asterisk">*</span></label>
                    <input type="text" id="custom_size" name="custom_size" placeholder="e.g. Bust: 35, Waist: 28, Hips: 38 (inches)" value="{{ old('custom_size') }}">
                </div>

                <div class="form-group">
                    <label for="details">Project Details <span class="required-asterisk">*</span></label>
                    <textarea id="details" name="details" rows="4" placeholder="Describe your project, inspiration, and any specific requirements" required style="width: 100%; background: transparent; border: 1px solid var(--border-light); border-radius: 10px; padding: 15px;">{{ old('details') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="inspiration_image">Inspiration Image <span style="text-transform:none;font-weight:normal;color:#888;">(JPG/PNG only, Optional)</span></label>
                    <input type="file" id="inspiration_image" name="inspiration_image" accept="image/png, image/jpeg, image/jpg" style="border: 1px dashed var(--border-light); border-radius: 8px; padding: 20px; background: rgba(255, 255, 255, 0.3);">
                </div>

                <div class="form-group checkbox-group" style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" style="margin-bottom: 0; text-transform: none; font-size: 0.8rem; letter-spacing: 0;">I agree to the terms of service and privacy policy</label>
                </div>

                <button type="submit" class="auth-btn">Request Quote</button>
            </form>
        </div>
    </div>
</main>

<!-- Size Guide Modal -->
<div class="size-modal" id="sizeGuideModal">
    <div class="size-modal-content">
        <span class="close-size-modal" id="closeSizeGuide">&times;</span>
        <div class="size-modal-header">
            <h2>Body Measurements</h2>
        </div>

        <div class="size-table-container">
            <div class="size-table-title">Centimeters</div>
            <table class="size-table">
                <thead>
                    <tr>
                        <th>EU</th><th>US</th><th>IT</th><th>UK</th><th>JP</th><th>AU</th><th>BUST</th><th>WAIST</th><th>HIPS</th><th>N.TO S.</th><th>SLEEVE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>36</td><td>4</td><td>40</td><td>8</td><td>7</td><td>8</td><td>84</td><td>66</td><td>94</td><td>12</td><td>62</td></tr>
                    <tr><td>38</td><td>6</td><td>42</td><td>10</td><td>9</td><td>10</td><td>88</td><td>70</td><td>98</td><td>12.25</td><td>62</td></tr>
                    <tr><td>40</td><td>8</td><td>44</td><td>12</td><td>11</td><td>12</td><td>92</td><td>74</td><td>102</td><td>12.5</td><td>62.5</td></tr>
                    <tr><td>42</td><td>10</td><td>46</td><td>14</td><td>13</td><td>14</td><td>96</td><td>78</td><td>106</td><td>12.75</td><td>62.5</td></tr>
                </tbody>
            </table>
        </div>

        <div class="size-table-container">
            <div class="size-table-title">Inches</div>
            <table class="size-table">
                <thead>
                    <tr>
                        <th>EU</th><th>US</th><th>IT</th><th>UK</th><th>JP</th><th>AU</th><th>BUST</th><th>WAIST</th><th>HIPS</th><th>N.TO S.</th><th>SLEEVE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>36</td><td>4</td><td>40</td><td>8</td><td>7</td><td>8</td><td>33.1</td><td>26</td><td>37</td><td>4.7</td><td>24.4</td></tr>
                    <tr><td>38</td><td>6</td><td>42</td><td>10</td><td>9</td><td>10</td><td>34.6</td><td>27.6</td><td>38.6</td><td>4.8</td><td>24.4</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/babel">
    const materialData = [
        { id: 'tulle', name: 'Tulle', image: '/img/tulle.jpg', description: 'A lightweight, fine netting made of various fibers. Soft and ethereal, perfect for creating volume and delicate layering.' },
        { id: 'chiffon', name: 'Chiffon', image: '/img/chiffon.jpg', description: 'A sheer, lightweight fabric with a soft flow. Known for its elegant drape and slightly rough texture.' },
        { id: 'silk', name: 'Silk', image: '/img/silk.jfif', description: 'A luxurious natural fiber known for its smooth texture, beautiful luster, and excellent draping qualities.' },
        { id: 'mikado', name: 'Mikado', image: '/img/mikado.avif', description: 'A heavyweight silk blend fabric with a subtle sheen and structured feel. Perfect for more architectural designs.' },
        { id: 'gazar', name: 'Gazar', image: '/img/gazar.jpg', description: 'A crisp, lightweight silk or synthetic fabric with a distinctive structure. Known for its sculptural qualities.' },
        { id: 'embroidered-lace', name: 'Embroidered Lace', image: '/img/embroidered-lace.jpg', description: 'An intricate fabric featuring delicate embroidery on a fine mesh. Adds elegant, romantic texture.' }
    ];

    const MaterialsChecklist = () => {
        const [hoveredMaterial, setHoveredMaterial] = React.useState(null);
        const [selectedMaterials, setSelectedMaterials] = React.useState([]);

        const toggleMaterial = (materialId) => {
            setSelectedMaterials(prev => prev.includes(materialId) ? prev.filter(id => id !== materialId) : [...prev, materialId]);
        };

        return (
            <div className="mt-2">
                <input type="hidden" name="selected_materials" value={selectedMaterials.join(', ')} />
                <div className="flex flex-col md:flex-row bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                    <div className="w-full md:w-1/2 p-4 space-y-1 flex flex-col items-start bg-gray-50/50">
                        {materialData.map((material) => (
                            <div 
                                key={material.id}
                                className={`flex items-center p-3 rounded-lg cursor-pointer transition-all duration-300 w-full relative ${hoveredMaterial?.id === material.id ? 'bg-white shadow-md transform translate-x-2 z-10 border-gray-200' : 'border-transparent'} ${selectedMaterials.includes(material.id) ? 'bg-white ring-2 ring-black shadow-sm' : 'hover:bg-gray-100'}`}
                                onMouseEnter={() => setHoveredMaterial(material)}
                                onMouseLeave={() => setHoveredMaterial(null)}
                                onClick={() => toggleMaterial(material.id)}
                            >
                                <input type="checkbox" checked={selectedMaterials.includes(material.id)} readOnly className="mr-3 h-4 w-4" />
                                <span className="text-[11px] font-medium uppercase tracking-widest text-left">{material.name}</span>
                            </div>
                        ))}
                    </div>
                    <div className="w-full md:w-1/2 bg-white p-6 border-l border-gray-200 flex flex-col justify-center min-h-[250px] shadow-xl z-10 relative">
                        {hoveredMaterial ? (
                            <div className="animate-fade-in">
                                <img src={hoveredMaterial.image} alt={hoveredMaterial.name} className="w-full h-32 object-cover rounded-lg mb-3 shadow-sm" />
                                <h4 className="text-xs font-bold uppercase tracking-widest mb-1">{hoveredMaterial.name}</h4>
                                <p className="text-[10px] text-gray-500 leading-relaxed">{hoveredMaterial.description}</p>
                            </div>
                        ) : (
                            <div className="text-center text-gray-300 text-xs italic">Hover "Materials" for details</div>
                        )}
                    </div>
                </div>
            </div>
        );
    };

    ReactDOM.render(<MaterialsChecklist />, document.getElementById('materials-selection-root'));
</script>

<script>
    // Modal Logic
    const modal = document.getElementById('sizeGuideModal');
    const btn = document.getElementById('openSizeGuide');
    const span = document.getElementById('closeSizeGuide');

    btn.onclick = function() { modal.classList.add('active'); }
    span.onclick = function() { modal.classList.remove('active'); }
    window.onclick = function(event) { if (event.target == modal) { modal.classList.remove('active'); } }

    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") { modal.classList.remove('active'); }
    });

    // Toggle Custom Service Input
    function toggleCustomService() {
        const serviceSelect = document.getElementById('service-type');
        const customServiceContainer = document.getElementById('custom-service-container');
        const customServiceInput = document.getElementById('custom_service_type');
        
        if (serviceSelect.value === 'other') {
            customServiceContainer.style.display = 'block';
            customServiceInput.required = true;
        } else {
            customServiceContainer.style.display = 'none';
            customServiceInput.required = false;
        }
    }

    // Toggle Custom Size Input
    function toggleCustomSize() {
        const sizeSelect = document.getElementById('size');
        const customSizeContainer = document.getElementById('custom-size-container');
        const customSizeInput = document.getElementById('custom_size');
        
        if (sizeSelect.value === 'custom') {
            customSizeContainer.style.display = 'block';
            customSizeInput.required = true;
        } else {
            customSizeContainer.style.display = 'none';
            customSizeInput.required = false;
        }
    }
</script>

@if(session('success') || session('appointment_success'))
    <!-- Centered Success Modal -->
    <div id="success-modal-overlay" class="success-modal-overlay active">
        <div class="success-modal-content">
            <div class="success-icon-wrapper">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="success-title">Success</h2>
            <p class="success-message">{{ session('success') ?? session('appointment_success') }}</p>
            <button class="success-continue-btn" type="button" onclick="closeSuccessModal({{ session('success') ? 'true' : 'false' }})">Continue</button>
        </div>
    </div>
    <script>
        function closeSuccessModal(isQuoteSuccess) {
            const modal = document.getElementById('success-modal-overlay');
            if (modal) {
                modal.classList.remove('active');
                // Wait for transition to finish then redirect to main page if quote success
                setTimeout(() => {
                    modal.style.display = 'none';
                    if (isQuoteSuccess) {
                        window.location.href = '/';
                    }
                }, 400);
            }
        }
    </script>
@endif

</body>
</html>
