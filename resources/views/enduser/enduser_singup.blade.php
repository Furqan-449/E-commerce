<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/enduser/singup_page.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="modal" id="signup-modal">
        <div class="modal-content">
            {{-- <span class="close-modal">&times;</span> --}}
            <div class="auth-form">
                <div class="auth-header">
                    <h2>Sign Up</h2>
                    <p>Join TechShop today</p>
                </div>

                <form id="signup-form" action="{{ route('singup') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="signup-name">Full Name</label>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" id="signup-name" placeholder="Enter your full name" name="name"
                                value="{{ old('name') }}">
                            <span style="color: red">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="signup-email">Email</label>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="signup-email" placeholder="Enter your email" name="email"
                                value="{{ old('email') }}">
                            <span style="color: red">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="signup-password">Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="signup-password" placeholder="Create a password" name="password">
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <span style="color: red">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="password-strength">
                            <div class="strength-meter">
                                <span class="strength-bar weak"></span>
                                <span class="strength-bar medium"></span>
                                <span class="strength-bar strong"></span>
                            </div>
                            <p class="strength-text">Password strength: <span>Weak</span></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="signup-confirm">Confirm Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="signup-confirm" placeholder="Confirm your password"
                                name="password_confirmation">
                        </div>
                    </div>

                    {{-- <div class="form-group terms-group">
                        <label class="terms-checkbox">
                            <input type="checkbox" id="agree-terms" required>
                            <span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy
                                    Policy</a></span>
                        </label>
                    </div> --}}

                    <button type="submit" class="auth-btn">Sign Up</button>

                    <div class="social-login">
                        <p>Or sign up with</p>
                        <div class="social-icons">
                            <a href="#" class="social-btn google"><i class="fab fa-google"></i></a>
                            <a href="#" class="social-btn facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-btn twitter"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>

                    <div class="auth-footer">
                        <p>Already have an account? <a href="{{ route('login_page') }}" id="switch-to-login">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Modal functionality
        const loginBtn = document.querySelector('.login-btn');
        const signupBtn = document.querySelector('.signup-btn');
        // const loginModal = document.getElementById('login-modal');
        // const signupModal = document.getElementById('signup-modal');
        // const closeModalBtns = document.querySelectorAll('.close-modal');
        // const switchToSignup = document.getElementById('switch-to-signup');
        // const switchToLogin = document.getElementById('switch-to-login');

        // Password strength indicator (for signup form)
        const passwordInput = document.getElementById('signup-password');
        const strengthBars = document.querySelectorAll('.strength-bar');
        const strengthText = document.querySelector('.strength-text span');

        if (passwordInput && strengthBars.length > 0 && strengthText) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;

                // Reset bars
                strengthBars.forEach(bar => bar.classList.remove('active'));

                // Check password strength
                if (password.length > 0) strength++;
                if (password.length >= 8) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;

                // Update UI
                if (password.length === 0) {
                    strengthText.textContent = '';
                } else if (strength <= 2) {
                    strengthBars[0].classList.add('active');
                    strengthText.textContent = 'Weak';
                    strengthText.style.color = 'var(--failure-color)';
                } else if (strength <= 4) {
                    strengthBars[0].classList.add('active');
                    strengthBars[1].classList.add('active');
                    strengthText.textContent = 'Medium';
                    strengthText.style.color = 'var(--warning-color)';
                } else {
                    strengthBars.forEach(bar => bar.classList.add('active'));
                    strengthText.textContent = 'Strong';
                    strengthText.style.color = 'var(--success-color)';
                }
            });
        }

        // Toggle password visibility
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');
        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>

</html>
