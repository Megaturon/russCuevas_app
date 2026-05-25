<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment - Russ Cuevas</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    @vite(['resources/css/styles2.css'])

    <script>
        // Prevent Sunday selection and restrict date range
        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date();
            let maxDate = new Date();
            maxDate.setDate(today.getDate() + 30);

            let minDate = today.toISOString().split('T')[0];
            let maxDateStr = maxDate.toISOString().split('T')[0];

            document.getElementById("date").setAttribute("min", minDate);
            document.getElementById("date").setAttribute("max", maxDateStr);

            document.getElementById("date").addEventListener("input", function(e) {
                let selectedDate = new Date(e.target.value);
                if (selectedDate.getDay() === 0) {
                    alert("Appointments cannot be scheduled on Sundays.");
                    e.target.setCustomValidity("Invalid date: Sunday");
                    e.target.value = "";
                } else {
                    e.target.setCustomValidity("");
                }
            });
        });
    </script>
</head>
<body class="auth-page">
    <header>
        <x-nav-bar></x-nav-bar>
    </header>

    <main class="quote-page" style="position: relative; overflow: hidden; background-image: none; background-color: #000;">
        <div class="auth-bg-carousel">
            <div class="carousel-item active" style="background-image: url('/img/orange.png'); background-position: center top;"></div>
            <div class="carousel-item" style="background-image: url('/img/model2.png'); background-position: center top;"></div>
            <div class="carousel-item" style="background-image: url('/img/whitem.png'); background-position: center 20%;"></div>
            <div class="auth-overlay"></div>
        </div>

        <div class="quote-container" style="max-width: 900px; position: relative; z-index: 10; margin: 5% auto; padding: 40px;">
            <div class="quote-content" style="text-align: center;">
                <h1 style="font-family: var(--font-serif); font-size: 2.2rem; margin-bottom: 10px; color: #111;">Book an Appointment</h1>
                <p style="color: #666; font-size: 0.9rem; margin-bottom: 30px;">Schedule a personal consultation at our artelier. We look forward to meeting you.</p>

                <form action="" method="POST" class="auth-form" style="display: flex; flex-direction: column; gap: 30px; text-align: left; margin-top: 20px;">
                    @csrf
                    
                    <!-- Main Row: Form Fields (Left) and Rules (Right) -->
                    <div style="display: flex; gap: 40px; flex-wrap: wrap;">
                        <!-- Left Side: All Inputs -->
                        <div style="flex: 1; min-width: 320px; display: flex; flex-direction: column; justify-content: flex-start; gap: 25px;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="name" style="font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: #333;">Full Name <span class="required-asterisk" style="color: red;">*</span></label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? '' }}" required placeholder="Enter your name" style="width: 100%; background: transparent; border: none; border-bottom: 1px solid #ccc; padding: 12px 0; font-size: 1rem; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderBottomColor='#111'" onblur="this.style.borderBottomColor='#ccc'">
                            </div>

                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="email" style="font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: #333;">Email Address <span class="required-asterisk" style="color: red;">*</span></label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" required placeholder="Enter your email" style="width: 100%; background: transparent; border: none; border-bottom: 1px solid #ccc; padding: 12px 0; font-size: 1rem; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderBottomColor='#111'" onblur="this.style.borderBottomColor='#ccc'">
                            </div>

                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="service_type" style="font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: #333;">Service Type <span class="required-asterisk" style="color: red;">*</span></label>
                                <select id="service_type" name="service_type" required style="width: 100%; border: none; border-bottom: 1px solid #ccc; padding: 12px 0; font-size: 1rem; outline: none; transition: border-color 0.3s; background: transparent; cursor: pointer;" onfocus="this.style.borderBottomColor='#111'" onblur="this.style.borderBottomColor='#ccc'">
                                    <option value="">Select Service Type</option>
                                    <option value="Fitting / Consultation">Fitting / Consultation</option>
                                    <option value="Measurements">Measurements</option>
                                    <option value="Style Consultation">Style Consultation</option>
                                    <option value="Pick-up">Pick-up</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 20px;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label for="date" style="font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: #333;">Appointment Date <span class="required-asterisk" style="color: red;">*</span></label>
                                    <input type="date" id="date" name="date" required style="width: 100%; background: transparent; border: none; border-bottom: 1px solid #ccc; padding: 12px 0; font-size: 1rem; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderBottomColor='#111'" onblur="this.style.borderBottomColor='#ccc'">
                                </div>

                                <div class="form-group" style="margin-bottom: 0;">
                                    <label for="time" style="font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: #333;">Preferred Time <span class="required-asterisk" style="color: red;">*</span></label>
                                    <select id="time" name="time" required style="width: 100%; border: none; border-bottom: 1px solid #ccc; padding: 12px 0; font-size: 1rem; outline: none; transition: border-color 0.3s; background: transparent; cursor: pointer;" onfocus="this.style.borderBottomColor='#111'" onblur="this.style.borderBottomColor='#ccc'">
                                        <option value="">Select Time</option>
                                        <option value="08:00">08:00 AM</option>
                                        <option value="09:00">09:00 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="12:00">12:00 PM</option>
                                        <option value="13:00">01:00 PM</option>
                                        <option value="14:00">02:00 PM</option>
                                        <option value="15:00">03:00 PM</option>
                                        <option value="16:00">04:00 PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Rules Section -->
                        <div style="flex: 0.8; min-width: 300px; display: flex; flex-direction: column; justify-content: center;">
                            <div style="background: rgba(255, 255, 255, 0.5); padding: 40px 30px; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                                <h3 style="font-family: var(--font-serif); text-transform: uppercase; letter-spacing: 3px; font-size: 1.1rem; margin-bottom: 20px; border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 10px; color: #111;">Rules & Regulations</h3>
                                <ul style="list-style: none; padding: 0; font-size: 0.95rem; color: #444; line-height: 2;">
                                    <li style="margin-bottom: 15px; display: flex; align-items: center;"><i class="fas fa-clock" style="width: 30px; color: var(--primary-color); font-size: 1.1rem;"></i> Arrive 10 mins early.</li>
                                    <li style="margin-bottom: 15px; display: flex; align-items: center;"><i class="fas fa-calendar-times" style="width: 30px; color: var(--primary-color); font-size: 1.1rem;"></i> No appointments on Sundays.</li>
                                    <li style="margin-bottom: 15px; display: flex; align-items: center;"><i class="fas fa-history" style="width: 30px; color: var(--primary-color); font-size: 1.1rem;"></i> 24h notice for rescheduling.</li>
                                    <li style="margin-bottom: 15px; display: flex; align-items: center;"><i class="fas fa-users" style="width: 30px; color: var(--primary-color); font-size: 1.1rem;"></i> Max one guest allowed.</li>
                                    <li style="margin-bottom: 15px; display: flex; align-items: center;"><i class="fas fa-tshirt" style="width: 30px; color: var(--primary-color); font-size: 1.1rem;"></i> Wear appropriate attire for fittings.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Row: Notes and Buttons (Centered) -->
                    <div style="max-width: 600px; width: 100%; margin: 10px auto 0; text-align: center;">
                        <div class="form-group" style="text-align: left; margin-bottom: 30px;">
                            <label for="notes" style="font-size: 0.8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: #333;">Additional Notes</label>
                            <textarea id="notes" name="notes" placeholder="Any specific requests or questions?" rows="4" style="width: 100%; background: transparent; border: 1px solid #ccc; border-radius: 8px; padding: 15px; font-size: 0.95rem; outline: none; transition: border-color 0.3s; margin-top: 10px; resize: vertical;" onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#ccc'"></textarea>
                        </div>

                        <button type="submit" style="width: 100%; padding: 16px; font-size: 1rem; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; border-radius: 8px; background-color: #111; color: #fff; border: none; cursor: pointer; transition: background 0.3s;" onmouseover="this.style.backgroundColor='#333'" onmouseout="this.style.backgroundColor='#111'">Submit Appointment</button>
                        
                        <div style="text-align: center; margin-top: 15px;">
                            <a href="/" style="color: #666; font-size: 0.85rem; text-decoration: underline;">Cancel and Return</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.carousel-item');
            if (items.length > 0) {
                let current = 0;
                setInterval(() => {
                    items[current].classList.remove('active');
                    current = (current + 1) % items.length;
                    items[current].classList.add('active');
                }, 5000);
            }
        });
    </script>
</body>
</html>
