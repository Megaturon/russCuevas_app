<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style2.css') }}">
    <title>Get a Quote - Russ Cuevas Artelier</title>
    
    <!-- React, ReactDOM, and Babel Scripts -->
    <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header>
  <nav class="navbar">
    <a href="RC.php" class="logo">
      <img src="{{ asset('img/RC_logo.jpg') }}" alt="Russ Cuevas Logo">
    </a>

    <div class="menu-toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>

    <div class="navbtns">
      <a href="RC.php">Gallery</a>
      <a class="about-btn">About Us</button>
		<ul class="dropdown-menu" id="aboutDropdown" style="display: none;">
			
				<li onclick="location.href = 'faq.php';">FAQ</li>
				<li onclick="location.href = 'terms.php';">Terms and Conditions</li>
				<li onclick="location.href = 'privacy.php';">Private Policy</li>
		</ul>
      <a href="getAppointment.php">Book Appointment</a>
      <a href="getAQuote.php">Get A Quote</a>
    </div>
	
	<div class="icons">    
		<div class = "dropdown">
            <a class="login-btn">
				<img src="{{ asset('img/user.png') }}" alt="User Profile" width="40" height="40">
			</a>
			<div class = "dropdown-content">
			 <ul class="dropdown-menu" id="loginDropdown" style="display: none;">
				<?php if(empty($logged_email)){?>
					<a href = "login.php"><li>Log In</li></a>
				<?php } else {?>
					<a href = "?logOut"><li>Log Out</li></a>
				<?php }?>
				<a href = "signup.php"><li>Sign Up</li></a>
			 </ul>
			</div>
		</div>
    </div>

  </nav>
</header>

    <main class="quote-page">
        <div class="quote-container">
            <div class="quote-content">
                <h1>Get a Custom Quote</h1>
                <p>Fill out the form below and we'll get back to you with a personalized estimate.</p>
                
                @if(session('success'))
                            <div class="alert alert-success" style="color: green; margin-bottom: 15px;">
                                {{ session('success') }}
                            </div>
                        @endif

                    <form id="quote-form" class="quote-form" action="{{ route('quote.store') }}" method="POST">
                        
                        @csrf 

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="service-type">Service Type</label>
                            <select id="service-type" name="service-type" required>
                                <option value="">Select a Category</option>
                                <option value="Wedding Gown" {{ old('service-type') == 'Wedding Gown' ? 'selected' : '' }}>Wedding Gown</option>  
                                <option value="Bridesmaids" {{ old('service-type') == 'Bridesmaids' ? 'selected' : '' }}>Bridesmaids</option>
                                <option value="Evening Gown" {{ old('service-type') == 'Evening Gown' ? 'selected' : '' }}>Evening Gown</option>
                                <option value="Cocktail Dress" {{ old('service-type') == 'Cocktail Dress' ? 'selected' : '' }}>Cocktail Dress</option>
                                <option value="Prom Dress" {{ old('service-type') == 'Prom Dress' ? 'selected' : '' }}>Prom Dress</option>                          
                                <option value="other" {{ old('service-type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                    <div id="materials-selection-root"></div>

                    <div class="form-group">
                        <label for="details">Project Details</label>
                        <textarea id="details" name="details" rows="4" placeholder="Describe your project, inspiration, and any specific requirements"></textarea>
                    </div>

                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="terms" name="terms" required="">
                        <label for="terms">I agree to the terms of service and privacy policy</label>
                    </div> 
                    <button type="submit" class="submit-btn">Request Quote</button>
                </form>
            </div>
        </div>
    </main>

    <script type="text/babel">
        // Materials Data
        const materialData = [
            {
                id: 'tulle',
                name: 'Tulle',
                image: 'img/tulle.jpg', // Updated path
                description: 'A lightweight, fine netting made of various fibers. Soft and ethereal, perfect for creating volume and delicate layering in garments.',
                characteristics: [
                    'Lightweight',
                    'Translucent',
                    'Creates volume',
                    'Versatile for layering'
                ]
            },
            {
                id: 'chiffon',
                name: 'Chiffon',
                image: 'img/chiffon.jpg', // Updated path
                description: 'A sheer, lightweight fabric with a soft flow. Known for its elegant drape and slightly rough texture.',
                characteristics: [
                    'Extremely lightweight',
                    'Sheer and delicate',
                    'Soft drape',
                    'Ideal for flowing designs'
                ]
            },
            {
                id: 'silk',
                name: 'Silk',
                image: 'img/silk.jfif', // Updated path
                description: 'A luxurious natural fiber known for its smooth texture, beautiful luster, and excellent draping qualities.',
                characteristics: [
                    'Smooth texture',
                    'Natural sheen',
                    'Excellent drape',
                    'Temperature regulating'
                ]
            },
            {
                id: 'mikado',
                name: 'Mikado',
                image: 'img/mikado.avif', // Updated path
                description: 'A heavyweight silk blend fabric with a subtle sheen and structured feel. Perfect for more architectural designs.',
                characteristics: [
                    'Structured',
                    'Heavyweight',
                    'Subtle sheen',
                    'Holds shape well'
                ]
            },
            {
                id: 'gazar',
                name: 'Gazar',
                image: 'img/gazar.jpg', // Updated path
                description: 'A crisp, lightweight silk or synthetic fabric with a distinctive structure. Known for its architectural qualities and ability to hold dramatic shapes.',
                characteristics: [
                    'Crisp texture',
                    'Lightweight yet structured',
                    'Holds bold silhouettes',
                    'Ideal for sculptural designs'
                ]
            },
            {
                id: 'embroidered-lace',
                name: 'Embroidered Lace',
                image: 'img/embroidered-lace.jpg', // Updated path
                description: 'An intricate fabric featuring delicate embroidery on a fine mesh or net background. Adds elegant, detailed texture and romantic quality to garments.',
                characteristics: [
                    'Intricate detailed design',
                    'Delicate and feminine',
                    'Adds textural interest',
                    'Versatile for decorative elements'
                ]
            }
        ];

        // Materials Checklist Component
        const MaterialsChecklist = () => {
            const [hoveredMaterial, setHoveredMaterial] = React.useState(null);
            const [selectedMaterials, setSelectedMaterials] = React.useState([]);

            const handleMaterialHover = (material) => {
                setHoveredMaterial(material);
            };

            const handleMaterialLeave = () => {
                setHoveredMaterial(null);
            };

            const toggleMaterial = (materialId) => {
                setSelectedMaterials(prev => 
                    prev.includes(materialId)
                        ? prev.filter(id => id !== materialId)
                        : [...prev, materialId]
                );
            };

            return (
                <div className="materials-section mt-0">
                <input type="hidden" name="selected_materials" value={selectedMaterials.join(', ')} />
                    <div className="flex flex-col md:flex-row bg-gray-50 rounded-lg p-6">
                        <div className="materials-list w-full md:w-1/2 pr-0 md:pr-8">
                            <div className="space-y-4">
                                {materialData.map((material) => (
                                    <div 
                                        key={material.id}
                                        className={`
                                            material-item 
                                            flex justify-between items-center 
                                            p-4 rounded-lg cursor-pointer 
                                            transition-all duration-300
                                            ${hoveredMaterial?.id === material.id ? 'bg-gray-200' : 'bg-white'}
                                            ${selectedMaterials.includes(material.id) ? 'ring-2 ring-indigo-500' : 'hover:bg-gray-100'}
                                            shadow-md
                                        `}
                                        onMouseEnter={() => handleMaterialHover(material)}
                                        onMouseLeave={handleMaterialLeave}
                                    >
                                        <div className="flex items-center">
                                            <input 
                                                type="checkbox"
                                                checked={selectedMaterials.includes(material.id)}
                                                onChange={() => toggleMaterial(material.id)}
                                                className="mr-4 h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500"
                                            />
                                            <span className="font-medium text-gray-800">{material.name}</span>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        <div className="material-details w-full md:w-1/2 mt-6 md:mt-0">
                            <div className="bg-white rounded-lg shadow-lg p-6 h-full">
                                {hoveredMaterial ? (
                                    <div className="material-hover-details">
                                        <img 
                                            src={hoveredMaterial.image} 
                                            alt={hoveredMaterial.name} 
                                            className="w-full h-64 object-cover rounded-lg mb-4"
                                        />
                                        <h3 className="text-xl font-bold mb-2 text-gray-900">{hoveredMaterial.name}</h3>
                                        <p className="text-gray-600 mb-4">{hoveredMaterial.description}</p>
                                        <div className="characteristics">
                                            <h4 className="font-semibold mb-2 text-gray-800">Characteristics:</h4>
                                            <ul className="list-disc list-inside text-gray-700">
                                                {hoveredMaterial.characteristics.map((char, index) => (
                                                    <li key={index}>{char}</li>
                                                ))}
                                            </ul>
                                        </div>
                                    </div>
                                ) : (
                                    <div className="flex items-center justify-center h-full text-gray-500">
                                        Hover over a material to see details
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Selected Materials Display */}
                    <div className="selected-materials mt-4">
                        <h3 className="text-1xl  mb-2">Selected Materials:</h3>
                        {selectedMaterials.length > 0 ? (
                            <div className="flex flex-wrap gap-2 mb-4">
                                {selectedMaterials.map(materialId => {
                                    const material = materialData.find(m => m.id === materialId);
                                    return (
                                        <span 
                                            key={materialId} 
                                            className="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm"
                                        >
                                            {material.name}
                                        </span>
                                    );
                                })}
                            </div>
                        ) : (
                            <p className="text-gray-500">No materials selected</p>
                        )}
                    </div>
                </div>
            );
        };

        // Render the component
        ReactDOM.render(
            <MaterialsChecklist />,
            document.getElementById('materials-selection-root')
        );
    </script>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.querySelector('.navbtns').classList.toggle('active');
            this.classList.toggle('active');
        });
		
		document.querySelector('.login-btn').addEventListener('click', function () {
    const dropdown = document.getElementById('loginDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
  });
  
  document.querySelector('.about-btn').addEventListener('click', function () {
    const dropdown = document.getElementById('aboutDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
  });

  // Close dropdowns when clicking outside
  document.addEventListener('click', function(event) {
	const isLoginBtn = event.target.closest('.login-btn');
	const isLoginDropdown = event.target.closest('#loginDropdown');
	const isAboutBtn = event.target.closest('.about-btn');
	const isAboutDropdown = event.target.closest('#aboutDropdown');
    
    // If click is outside gallery button and dropdown
	if (!isLoginBtn && !isLoginDropdown) {
      document.getElementById('loginDropdown').style.display = 'none';
    }
	if (!isAboutBtn && !isAboutDropdown) {
      document.getElementById('aboutDropdown').style.display = 'none';
    }
  });
  
  
    </script>
	
</body>
</html>
