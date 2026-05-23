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

    <main class="quote-page">
        <div class="quote-container" style="max-width: 900px;">
            <div class="quote-content">
                <h1>Book an Appointment</h1>
                <p>Schedule a personal consultation at our artelier. We look forward to meeting you.</p>

                <div style="display: flex; gap: 40px; flex-wrap: wrap;">
                    <!-- Appointment Form -->
                    <div style="flex: 1; min-width: 300px;">
                        <form action="" method="POST" class="auth-form">
                            @csrf
                            <div class="form-group">
                                <label for="name">Full Name <span class="required-asterisk">*</span></label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? '' }}" required placeholder="Enter your name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address <span class="required-asterisk">*</span></label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" required placeholder="Enter your email">
                            </div>

                            <div class="signup-grid">
                                <div class="form-group">
                                    <label for="date">Appointment Date <span class="required-asterisk">*</span></label>
                                    <input type="date" id="date" name="date" required style="border-bottom: 1px solid var(--border-light); background: transparent; padding: 12px 0; width: 100%;">
                                </div>

                                <div class="form-group">
                                    <label for="time">Preferred Time <span class="required-asterisk">*</span></label>
                                    <select id="time" name="time" required style="border-bottom: 1px solid var(--border-light); background: transparent; padding: 12px 0; width: 100%;">
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

                            <div class="form-group">
                                <label for="notes">Additional Notes</label>
                                <textarea id="notes" name="notes" placeholder="Any specific requests or questions?" rows="3" style="width: 100%; background: transparent; border: 1px solid var(--border-light); border-radius: 10px; padding: 15px; margin-top: 10px;"></textarea>
                            </div>

                            <button type="submit" class="auth-btn">Submit Appointment</button>
                            <div class="auth-footer">
                                <a href="/" class="back-link">Cancel and Return</a>
                            </div>
                        </form>
                    </div>

                    <!-- Rules Section -->
                    <div style="flex: 0.8; min-width: 250px; background: rgba(0,0,0,0.03); padding: 30px; border-radius: 15px; border: 1px solid rgba(0,0,0,0.05);">
                        <h3 style="font-family: var(--font-serif); text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; margin-bottom: 20px; border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 10px;">Rules & Regulations</h3>
                        <ul style="list-style: none; padding: 0; font-size: 0.8rem; color: var(--secondary-color); line-height: 1.8;">
                            <li style="margin-bottom: 12px;"><i class="fas fa-clock" style="margin-right: 10px; color: var(--primary-color);"></i> Arrive 10 mins early.</li>
                            <li style="margin-bottom: 12px;"><i class="fas fa-calendar-times" style="margin-right: 10px; color: var(--primary-color);"></i> No appointments on Sundays.</li>
                            <li style="margin-bottom: 12px;"><i class="fas fa-history" style="margin-right: 10px; color: var(--primary-color);"></i> 24h notice for rescheduling.</li>
                            <li style="margin-bottom: 12px;"><i class="fas fa-users" style="margin-right: 10px; color: var(--primary-color);"></i> Max one guest allowed.</li>
                            <li style="margin-bottom: 12px;"><i class="fas fa-tshirt" style="margin-right: 10px; color: var(--primary-color);"></i> Wear appropriate attire for fittings.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

