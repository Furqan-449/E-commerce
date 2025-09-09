<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/auth/login.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="login-container">
        {{-- {/* Left Branding Panel */} --}}
        <div class="brand-panel">
            <div class="logo">
                <i class="fas fa-file-invoice logo-icon"></i>
                <div class="logo-text">SmartInvoice</div>
            </div>
            <p class="brand-description">
                The complete invoicing solution for freelancers and small
                businesses. Manage clients, payments, and reports in one place.
            </p>
            <ul class="features-list">
                <li>
                    <i class="fas fa-check-circle"></i> Create
                    professional invoices in minutes
                </li>
                <li>
                    <i class="fas fa-check-circle"></i> Accept online
                    payments worldwide
                </li>
                <li>
                    <i class="fas fa-check-circle"></i> Real-time
                    business analytics
                </li>
            </ul>
        </div>

        {{-- {/* Right Form Panel */} --}}
        <div class="form-panel">
            @if (session('dasherror'))
                <div class="error-box" id="dash-error-box"
                    style="border: 1px solid #e74c3c; background: #fdecea; color: #e74c3c; padding: 20px; border-radius: 6px; text-align: center; width: 65%; margin-bottom: 10px;">

                    {{ session('dasherror') }}

                </div>
            @endif
            <form class="login-form" method="post" action="{{ route('admin_login_success') }}">
                @csrf
                <h2 class="form-title">Welcome Back</h2>
                @if ($errors->has('noemail'))
                    <div class="error-box" id="error-box"
                        style="border: 1px solid #e74c3c; background: #fdecea; color: #e74c3c; padding: 10px; border-radius: 6px; text-align: center; width: 100%; margin-bottom: 10px;">

                        {{ $errors->first('noemail') }}

                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" placeholder="you@example.com" value="{{ old('email') }}"
                            name="email" />
                    </div>
                    <span class="error-message">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" placeholder="••••••••" name="password" />
                        {{-- <i class="fas fa-eye password-toggle" id="togglePassword"></i> --}}
                    </div>
                    <span class="error-message">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                    <a href="#" class="forgot-password">
                        Forgot password?
                    </a>
                </div>

                <button type="submit" class="btn btn-primary">
                    Log In
                </button>

                <div class="divider">or</div>

                <div class="social-login">
                    <button type="button" class="social-btn">
                        <i class="fab fa-google"></i>
                    </button>
                    <button type="button" class="social-btn">
                        <i class="fab fa-microsoft"></i>
                    </button>
                    <button type="button" class="social-btn">
                        <i class="fab fa-apple"></i>
                    </button>
                </div>

                <p class="signup-link">
                    Don't have an account? <a href="{{ route('sign_up') }}">Sign up</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const error = document.getElementById('error-box');
            const dash_error = document.getElementById('dash-error-box');
            if (error) {
                setTimeout(() => {
                    error.style.display = 'none';
                }, 2000);
            }

            if (dash_error) {
                setTimeout(() => {
                    dash_error.style.display = 'none';
                }, 2000);
            }
        });
    </script>
</body>

</html>
