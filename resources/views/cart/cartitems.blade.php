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
    @vite(['resources/css/cart/cartitems.css', 'resources/js/app.js'])
    <title>TechShop - Home</title>
</head>

<body>
    @php
        $favourites = session()->get('favourites', []);
    @endphp
    <!-- New Header Section -->
    <header class="main-header">
        <div class="header-container">
            <a href="#" class="logo">
                <i class="fas fa-laptop-code"></i>
                <span>TechShop</span>
            </a>
            <nav class="main-nav">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Products</a></li>
                    {{-- <li><a href="{{ route('profile') }}">Profile</a></li> --}}
                    <li><a href="{{ route('favourite_items') }}">Favorites</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                @if (!Auth::guard('endusers')->user())
                    <a href="{{ route('login_page') }}" class="login-btn">Login</a>
                @else
                    <a href="{{ route('user_logout') }}" class="login-btn">Logout</a>
                @endif
                {{-- <a href="#" class="signup-btn">Sign Up</a> --}}
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <form action="{{ route('product_search') }}" method="GET" class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search products..." name="search"
                            value="{{ request('search') }}">
                    </form>
                </div>

                <div class="cart-wrapper">
                    <a href="{{ route('cart_data') }}" style="text-decoration: none">
                        <button class="cart-btn">
                            <i class="fas fa-shopping-cart cart-icon"></i>
                            @if (Auth::guard('endusers')->user() && $total > 0)
                                <span class="notification-badge">{{ $total }}</span>
                            @endif
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        @if (session('success'))
            <div class="alert alert-success"
                style="border: 1px solid #72f7bf; background: #64e99b; color: green; padding: 10px; border-radius: 6px; text-align: center; width: 30%; margin:0px auto 10px auto; display: flex; justify-content:space-around">

                {{ session('success') }}
                <i class="fas fa-times close-alert"></i>
            </div>
        @endif

        <!-- Image Slider -->
        <section class="image-slider">
            <div class="slider-container">
                <div class="slide active" style="height: 400px; width: 1200px;">
                    <img src="{{ asset('storage/items/slid1.png') }}" alt="Tech Deals">
                </div>
                <div class="slide" style="height: 400px; width:1200px;">
                    <img src="{{ asset('storage/items/slid2.png') }}" alt="New Arrivals">
                </div>
                <div class="slide" style="height: 400px; width: 1200px;">
                    <img src="{{ asset('storage/items/slid3.png') }}" alt="Summer Sale">
                </div>
            </div>
            <div class="slider-dots">
                <div class="slider-dot active"></div>
                <div class="slider-dot"></div>
                <div class="slider-dot"></div>
            </div>
        </section>

        <!-- Flash Sale Section -->
        <section class="flash-sale-section">
            <div class="flash-sale-banner">
                <h3><i class="fas fa-bolt"></i> FLASH SALE</h3>
                <div class="countdown">
                    <div class="countdown-item">
                        12 <span>HOURS</span>
                    </div>
                    <div class="countdown-item">
                        45 <span>MINS</span>
                    </div>
                    <div class="countdown-item">
                        30 <span>SECS</span>
                    </div>
                </div>
            </div>
            <div class="section-header">
                <h2 class="section-title">Hot Deals</h2>
                <a href="#" class="shop-all">Shop All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="flash-sale-container">
                <div class="products-container">
                    @foreach ($data->take(6) as $product)
                        <a href="{{ route('single_item_show', $product->id) }}" style="text-decoration:none">
                            <div class="product-card">
                                <div class="product-badge">
                                    @if ($product->quantity > 0)
                                        <span class="in-stock">In Stock</span>
                                    @else
                                        <span class="out-stock">Out of Stock</span>
                                    @endif
                                </div>
                                @if ($product->discount > 0)
                                    <div class="discount-badge">-{{ $product->discount }}%</div>
                                @endif
                                <div class="imag-parent">
                                    <img src="{{ url('storage/items/', $product->image) }}"
                                        alt="{{ $product->item_name }}" class="product-image">
                                </div>
                                {{-- <div class="product-actions">
                                    <button class="action-btn"><i class="fas fa-heart"></i></button>
                                    <button class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                                    <button class="action-btn"><i class="fas fa-eye"></i></button>
                                </div> --}}
                                <div class="product-info">
                                    <h3 class="product-name">{{ $product->name }}</h3>
                                    <div class="product-price">
                                        <span
                                            class="current-price">${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}</span>
                                        @if ($product->discount > 0)
                                            <span
                                                class="original-price">${{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="product-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="rating-count">(24)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="categories-section">
            <div class="section-header">
                <h2 class="section-title">Shop by Category</h2>
                <a href="#" class="shop-all">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="categories-grid">
                @foreach ($categories->take(16) as $category)
                    <a href="{{ route('category_product', $category->id) }}" style="text-decoration: none;">
                        <div class="category-card">
                            <div class="category-image">
                                {{-- <img src="https://via.placeholder.com/150?text={{ urlencode($category->name) }}"
                                    alt="{{ $category->name }}"> --}}
                            </div>
                            <h3 class="category-name">{{ $category->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Newsletter Section -->
        {{-- <section class="newsletter-section">
            <div class="newsletter-content">
                <h3 class="newsletter-title">Subscribe to Our Newsletter</h3>
                <p class="newsletter-desc">Get the latest updates on new products and upcoming sales</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email address">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </section> --}}

        <!-- Just For You Section -->
        <section class="just-for-you-section">
            <div class="section-header">
                <h2 class="section-title">Recommended For You</h2>
                <a href="#" class="shop-all">View More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="products-container">
                @foreach ($data as $product)
                    <a href="{{ route('single_item_show', $product->id) }}" style="text-decoration: none">
                        <div class="product-card">
                            <div class="product-badge">
                                @if ($product->quantity > 0)
                                    <span class="in-stock">In Stock</span>
                                @else
                                    <span class="out-stock">Out of Stock</span>
                                @endif
                            </div>
                            @if ($product->discount > 0)
                                <div class="discount-badge">-{{ $product->discount }}%</div>
                            @endif
                            <div class="imag-parent">
                                <img src="{{ url('storage/items/', $product->image) }}"
                                    alt="{{ $product->item_name }}" class="product-image">
                            </div>
                            {{-- <div class="product-actions">
                                <button class="action-btn"><i class="fas fa-heart"></i></button>
                                <button class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                            </div> --}}
                            <div class="product-info">
                                <h3 class="product-name">{{ $product->item_name }}</h3>
                                <div class="product-price">
                                    <span
                                        class="current-price">${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}</span>
                                    @if ($product->discount > 0)
                                        <span class="original-price">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span class="rating-count">(42)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Payment Methods -->
        <section class="payment-methods">
            <h3 class="payment-title">We Accept</h3>
            <div class="payment-icons">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-apple-pay"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>TechShop</h3>
                <p>Your one-stop shop for all tech gadgets and accessories. We provide high-quality products at
                    competitive prices with excellent customer service.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Shop</h3>
                <ul>
                    <li><a href="#">Laptops</a></li>
                    <li><a href="#">Smartphones</a></li>
                    <li><a href="#">Tablets</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Gaming</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Customer Service</h3>
                <ul>
                    <li><a href="#"><i class="fas fa-question-circle"></i> FAQ</a></li>
                    <li><a href="#"><i class="fas fa-truck"></i> Shipping Policy</a></li>
                    <li><a href="#"><i class="fas fa-exchange-alt"></i> Return Policy</a></li>
                    <li><a href="#"><i class="fas fa-lock"></i> Privacy Policy</a></li>
                    <li><a href="#"><i class="fas fa-file-alt"></i> Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> 123 Tech Street, Silicon Valley</a>
                    </li>
                    <li><a href="#"><i class="fas fa-phone"></i> (123) 456-7890</a></li>
                    <li><a href="#"><i class="fas fa-envelope"></i> info@techshop.com</a></li>
                    <li><a href="#"><i class="fas fa-clock"></i> Mon-Fri: 9AM - 6PM</a></li>
                    <li><a href="#"><i class="fas fa-clock"></i> Sat-Sun: 10AM - 4PM</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 TechShop. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Image Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');

        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        // Add click event to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Change slide every 3 seconds
        setInterval(nextSlide, 3000);

        // Alert timeout
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) alert.style.display = 'none';
        }, 3000);

        // Close alert when X is clicked
        document.querySelectorAll('.close-alert').forEach(button => {
            button.addEventListener('click', (e) => {
                e.target.parentElement.style.display = 'none';
            });
        });

        // Modal functionality
        // const loginBtn = document.querySelector('.login-btn');
        // const signupBtn = document.querySelector('.signup-btn');
        // const loginModal = document.getElementById('login-modal');
        // const signupModal = document.getElementById('signup-modal');
        // const closeModalBtns = document.querySelectorAll('.close-modal');
        // const switchToSignup = document.getElementById('switch-to-signup');
        // const switchToLogin = document.getElementById('switch-to-login');

        // // Open login modal
        // if (loginBtn) {
        //     loginBtn.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         loginModal.style.display = 'block';
        //         document.body.style.overflow = 'hidden';
        //     });
        // }

        // // Open signup modal
        // if (signupBtn) {
        //     signupBtn.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         signupModal.style.display = 'block';
        //         document.body.style.overflow = 'hidden';
        //     });
        // }

        // // Close modals
        // closeModalBtns.forEach(btn => {
        //     btn.addEventListener('click', function() {
        //         loginModal.style.display = 'none';
        //         signupModal.style.display = 'none';
        //         document.body.style.overflow = 'auto';
        //     });
        // });

        // // Switch between login and signup
        // if (switchToSignup) {
        //     switchToSignup.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         loginModal.style.display = 'none';
        //         signupModal.style.display = 'block';
        //     });
        // }

        // if (switchToLogin) {
        //     switchToLogin.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         signupModal.style.display = 'none';
        //         loginModal.style.display = 'block';
        //     });
        // }

        // // Close modal when clicking outside
        // window.addEventListener('click', function(e) {
        //     if (e.target === loginModal) {
        //         loginModal.style.display = 'none';
        //         document.body.style.overflow = 'auto';
        //     }
        //     if (e.target === signupModal) {
        //         signupModal.style.display = 'none';
        //         document.body.style.overflow = 'auto';
        //     }
        // });

        // Form submission
        // document.getElementById('login-form').addEventListener('click', function(e) {
        //     e.preventDefault();
        //     // Add your login logic here
        //     // alert('Login functionality would be implemented here');
        //     // loginModal.style.display = 'none';
        //     document.body.style.overflow = 'auto';
        // });

        // document.getElementById('signup-form')?.addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     // Add your signup logic here
        //     alert('Signup functionality would be implemented here');
        //     signupModal.style.display = 'none';
        //     document.body.style.overflow = 'auto';
        // });

        // Password strength indicator (for signup form)
        // const passwordInput = document.getElementById('signup-password');
        // const strengthBars = document.querySelectorAll('.strength-bar');
        // const strengthText = document.querySelector('.strength-text span');

        // if (passwordInput && strengthBars.length > 0 && strengthText) {
        //     passwordInput.addEventListener('input', function() {
        //         const password = this.value;
        //         let strength = 0;

        //         // Reset bars
        //         strengthBars.forEach(bar => bar.classList.remove('active'));

        //         // Check password strength
        //         if (password.length > 0) strength++;
        //         if (password.length >= 8) strength++;
        //         if (/[A-Z]/.test(password)) strength++;
        //         if (/[0-9]/.test(password)) strength++;
        //         if (/[^A-Za-z0-9]/.test(password)) strength++;

        //         // Update UI
        //         if (password.length === 0) {
        //             strengthText.textContent = '';
        //         } else if (strength <= 2) {
        //             strengthBars[0].classList.add('active');
        //             strengthText.textContent = 'Weak';
        //             strengthText.style.color = 'var(--failure-color)';
        //         } else if (strength <= 4) {
        //             strengthBars[0].classList.add('active');
        //             strengthBars[1].classList.add('active');
        //             strengthText.textContent = 'Medium';
        //             strengthText.style.color = 'var(--warning-color)';
        //         } else {
        //             strengthBars.forEach(bar => bar.classList.add('active'));
        //             strengthText.textContent = 'Strong';
        //             strengthText.style.color = 'var(--success-color)';
        //         }
        //     });
        // }

        // // Toggle password visibility
        // const togglePasswordButtons = document.querySelectorAll('.toggle-password');
        // togglePasswordButtons.forEach(button => {
        //     button.addEventListener('click', function() {
        //         const input = this.parentElement.querySelector('input');
        //         const icon = this.querySelector('i');

        //         if (input.type === 'password') {
        //             input.type = 'text';
        //             icon.classList.remove('fa-eye');
        //             icon.classList.add('fa-eye-slash');
        //         } else {
        //             input.type = 'password';
        //             icon.classList.remove('fa-eye-slash');
        //             icon.classList.add('fa-eye');
        //         }
        //     });
        // });

        // Newsletter form submission
        // document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     const email = this.querySelector('input').value;
        //     if (email) {
        //         alert('Thank you for subscribing with: ' + email);
        //         this.querySelector('input').value = '';
        //     }
        // });

        // Product action buttons
        // document.querySelectorAll('.action-btn').forEach(button => {
        //     button.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         e.stopPropagation();
        //         const icon = this.querySelector('i');

        //         if (icon.classList.contains('fa-heart')) {
        //             // Toggle favorite
        //             if (icon.classList.contains('text-red-500')) {
        //                 icon.classList.remove('text-red-500');
        //             } else {
        //                 icon.classList.add('text-red-500');
        //             }
        //         } else if (icon.classList.contains('fa-shopping-cart')) {
        //             // Add to cart
        //             alert('Product added to cart');
        //         } else if (icon.classList.contains('fa-eye')) {
        //             // Quick view
        //             alert('Quick view functionality would go here');
        //         }
        //     });
        // });
    </script>
</body>

</html>
