<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Russ Cuevas</title>
    @vite(['resources/css/styles2.css', 'resources/css/styles_resetpass.css'])
	 <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	 <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
	 <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
</head>
<body>
    <header>
        <x-nav-bar></x-nav-bar>
    </header>
    <!-- Reset Password Form -->
    <div class="reset-password-container">
        <h1>Reset Password</h1>
        
        <form action="" method="post">
            <div class="password-field input-field">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Enter new password" required>
                <i class="fas fa-eye-slash toggle-password" data-target="password"></i>
                
                <div class="password-strength">
                    <div class="password-strength-meter" id="passwordStrengthMeter"></div>
                </div>
                
                <p class="password-info" id="passwordInfo">Password should be at least 8 characters</p>
            </div>
            
            <div class="password-field input-field">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
                <i class="fas fa-eye-slash toggle-password" data-target="confirm_password"></i>
                
            </div>
            
            <div class="login-button">
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const toggleButtons = document.querySelectorAll('.toggle-password');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    } else {
                        passwordInput.type = 'password';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    }
                });
            });
            
            // Password strength checker
            const passwordInput = document.getElementById('password');
            const strengthMeter = document.getElementById('passwordStrengthMeter');
            const passwordInfo = document.getElementById('passwordInfo');
            
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let tips = [];
                
                // Length check
                if (password.length >= 8) {
                    strength += 1;
                } else {
                    tips.push("at least 8 characters");
                }
                
                // Uppercase check
                if (/[A-Z]/.test(password)) {
                    strength += 1;
                } else {
                    tips.push("uppercase letter");
                }
                
                // Lowercase check
                if (/[a-z]/.test(password)) {
                    strength += 1;
                } else {
                    tips.push("lowercase letter");
                }
                
                // Number check
                if (/[0-9]/.test(password)) {
                    strength += 1;
                } else {
                    tips.push("number");
                }
                
                // Special character check
                if (/[^A-Za-z0-9]/.test(password)) {
                    strength += 1;
                } else {
                    tips.push("special character");
                }
                
                // Update strength meter
                strengthMeter.className = 'password-strength-meter';
                
                if (password.length === 0) {
                    strengthMeter.style.width = '0%';
                    passwordInfo.textContent = "Password should be at least 8 characters";
                } else {
                    if (strength <= 2) {
                        strengthMeter.classList.add('weak');
                        passwordInfo.textContent = "Weak - Add " + tips.join(", ");
                    } else if (strength === 3) {
                        strengthMeter.classList.add('medium');
                        passwordInfo.textContent = "Medium - Add " + tips.join(", ");
                    } else if (strength === 4) {
                        strengthMeter.classList.add('strong');
                        passwordInfo.textContent = "Strong - Add " + tips.join(", ");
                    } else {
                        strengthMeter.classList.add('very-strong');
                        passwordInfo.textContent = "Very Strong";
                    }
                }
            });
            
            // Check password match
            const confirmInput = document.getElementById('confirm_password');
            
            confirmInput.addEventListener('input', function() {
                if (passwordInput.value !== this.value) {
                    this.setCustomValidity('Passwords do not match');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    </script>
</body>
</html>