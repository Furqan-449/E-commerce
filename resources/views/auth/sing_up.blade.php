<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/auth/sing_up.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="signup-container">
        {{-- {/* Left Branding Panel (Same as login) */} --}}
        <div class="brand-panel">
            <div class="logo">
                <i class="fas fa-file-invoice logo-icon"></i>
                <div class="logo-text">SmartInvoice</div>
            </div>
            <p class="brand-description">
                Join thousands of businesses managing their invoices smarter. Get
                started in just 2 minutes.
            </p>
            <ul class="features-list">
                <li>
                    <i class="fas fa-check-circle"></i> No credit card
                    required
                </li>
                <li>
                    <i class="fas fa-check-circle"></i> Free 14-day
                    trial
                </li>
                <li>
                    <i class="fas fa-check-circle"></i> Cancel anytime
                </li>
            </ul>
        </div>

        {{-- {/* Right Form Panel */} --}}
        <div class="form-panel">
            <form class="signup-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                @if (session('delete'))
                    <div class="alert alert-danger"
                        style="border: 1px solid #e74c3c; background: #fdecea; color: #e74c3c; padding: 10px; border-radius: 6px; text-align: center; width: 30%; margin:0px auto 10px auto; display: flex; justify-content:space-around">
                        {{ session('delete') }}
                    </div>
                @endif
                <h2 class="form-title">Create Your Account</h2>

                <!-- Profile Image Upload -->
                <div class="img-group">
                    {{-- <label for="profile_image">Profile Image</label> --}}
                    <div id="image-preview-container" style="margin-top:10px; display:none;">
                        <img id="image-preview" src="#" alt="Image Preview"
                            style="max-width: 120px; max-height: 120px; border-radius: 8px; border: 1px solid #ccc;" />
                    </div>
                    <div class="input-with-icon">
                        <i class="fas fa-image input-icon"></i>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" />
                        <span class="error-message">
                            @error('profile_image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" id="name" placeholder="John Doe" value="{{ old('name') }}"
                            name="name" />
                    </div>
                    <span class="error-message">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="email">Business Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" placeholder="you@yourbusiness.com"
                            value="{{ old('email') }}" name="email" />
                    </div>
                    <span class="error-message">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span> <br>
                    {{-- <span class="error-message">
                        @session('email')
                            {{ session('email') }}
                        @endsession
                    </span> --}}
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" placeholder="••••••••" name="password" />
                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    </div>
                    <span class="error-message">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="confirm-password" name="password_confirmation"
                            placeholder="••••••••" />
                    </div>
                    <span class="error-message">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="business-type">Business Type</label>
                    <select id="business-type" name="business">
                        <option value="">
                            --Select your business type--
                        </option>
                        <option value="freelancer" {{ old('business') == 'freelancer' ? 'selected' : '' }}>
                            Freelancer/Sole
                            Proprietor</option>
                        <option value="llc" {{ old('business') == 'llc' ? 'selected' : '' }}>LLC/Corporation
                        </option>
                        <option value="nonprofit" {{ old('business') == 'nonprofit' ? 'selected' : '' }}>Nonprofit
                        </option>
                        <option value="other" {{ old('businesss') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    <span class="error-message">
                        @error('business')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" value="1"
                        {{ old('terms') ? 'checked' : '' }} />
                    <label for="terms" class="terms-text">
                        I agree to the <a href="#">Terms of Service</a> and{" "}
                        <a href="#">Privacy Policy</a>. I understand SmartInvoice will
                        use my data as described in these policies. <br>
                        <span class="error-message">
                            @error('terms')
                                {{ $message }}
                            @enderror
                        </span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">
                    Create Account
                </button>

                <p class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Log in</a>
                </p>
            </form>
        </div>
    </div>
    @vite(['resources/js/auth/sing_up.js'])

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) alert.style.display = 'none';
        }, 1000);
    </script>
</body>


</html>
