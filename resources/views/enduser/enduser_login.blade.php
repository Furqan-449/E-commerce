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
    @vite(['resources/css/enduser/login_page.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="modal" id="login-modal">
        <div class="modal-content">
            {{-- <span class="close-modal">&times;</span> --}}
            <div class="auth-form">
                <div class="auth-header">
                    <h2>Login</h2>
                    <p>Welcome back to TechShop</p>
                </div>

                <form id="login-form" action="{{ route('login_success') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="login-email" placeholder="Enter your email" name="email"
                                value="{{ old('email') }}">
                            <span style="color: red">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="login-password" placeholder="Enter your password"
                                name="password">
                            {{-- <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button> --}}
                            <span style="color: red">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-options">
                            {{-- <label class="remember-me">
                                <input type="checkbox" id="remember-me">
                                <span>Remember me</span>
                            </label> --}}
                            <a href="{{ route('forget_password') }}" class="forgot-password">Forgot password?</a>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn">Login</button>

                    <div class="social-login">
                        <p>Or login with</p>
                        <div class="social-icons">
                            <a href="{{ route('google_login') }}" class="social-btn google"
                                style="text-decoration: none"><i class="fab fa-google"></i></a>
                            {{-- <a href="#" class="social-btn facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-btn twitter"><i class="fab fa-twitter"></i></a> --}}
                        </div>
                    </div>

                    <div class="auth-footer">
                        <p>Don't have an account? <a href="{{ route('singup_page') }}" id="switch-to-signup">Sign up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
