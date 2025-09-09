<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/cart/single_item_show.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <!-- Header (Same as before) -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-laptop-code"></i>
                <span>TechShop</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#" class="active">Products</a></li>
                    {{-- <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li> --}}
                    <li><a href="{{ route('favourite_items') }}">Favorites</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                @if (!Auth::guard('endusers')->user())
                    <a href="{{ route('login_page') }}" class="login-btn">Login</a>
                @else
                    <a href="{{ route('user_logout') }}" class="login-btn">Logout</a>
                @endif
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

    <!-- Product Details Content - Three Column Layout -->
    <div class="product-details-container">
        <div class="product-details-row">
            <!-- Column 1 - Product Image -->
            <div class="product-image-column">
                <img src="{{ asset('storage/items/' . $product->image) }}" alt="{{ $product->item_name }}"
                    class="product-main-image">
                <div class="product-thumbnails">
                    @if ($findvariant)
                        @foreach ($findvariant as $otherimage)
                            <img src="{{ asset('storage/items/' . $otherimage->variant_image) }}"
                                image-id="{{ $otherimage->id }}" alt="Thumbnail" class="product-thumbnail">
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Column 2 - Product Info -->
            <div class="product-info-column">

                <h1 class="product-name">{{ $product->name }}</h1>
                <div class="product-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span class="product-rating-count">(42 reviews)</span>
                </div>
                <!-- Inside your product-info-column div, replace the price section with this: -->
                <div style="display: flex; text-align: center; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="product-price">${{ $product->price }}</p>
                        <div class="quantity-selector">
                            <button class="quantity-btn minus">-</button>
                            <input type="number" class="quantity-input" value="1" min="1"
                                max="{{ $product->quantity }}">
                            <button class="quantity-btn plus">+</button>
                        </div>
                    </div>
                    <button class="favorite-btn" data-product-id="{{ $product->id }}"
                        style="background: none; border: none; cursor: pointer;">
                        @if ($isFavorite)
                            <i class="far fa-heart heart-empty" style="display: none;"></i> <!-- Empty heart -->
                            <i class="fas fa-heart heart-filled"></i> <!-- Filled heart -->
                        @else
                            <i class="far fa-heart heart-empty"></i> <!-- Empty heart -->
                            <i class="fas fa-heart heart-filled" style="display: none;"></i> <!-- Filled heart -->
                        @endif
                    </button>
                </div>
                <div class="product-actions">
                    @if ($product->quantity > 0)
                        <form action="{{ route('buy_single_item', $product->id) }}" method="post"
                            style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="quantity" class="quantity-field" value="1">
                            <button type="submit" class="buy-now-btn">Buy Now</button>
                        </form>
                        <a href="{{ route('add_to', $product->id) }}" id="route" style="text-decoration: none">
                            <button class="add-to-cart-btn">Add to
                                Cart</button></a>
                    @else
                        <button class="add-to-cart-btn" disabled style="opacity: 0.6; cursor: not-allowed;">Out of
                            Stock</button>
                    @endif
                </div>
            </div>

            <!-- Column 3 - Delivery Options -->
            <div class="delivery-column">
                <h3>Delivery Options</h3>
                <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="delivery-info">
                        <h4>Standard Delivery</h4>
                        <p>3-5 business days • Free shipping on orders over $50</p>
                    </div>
                </div>
                <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="delivery-info">
                        <h4>Express Delivery</h4>
                        <p>1-2 business days • $9.99</p>
                    </div>
                </div>
                <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="delivery-info">
                        <h4>Pickup In Store</h4>
                        <p>Available today at our downtown location</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Reviews Section (Below the three columns) -->
        <div class="customer-reviews">
            <h3>Customer Reviews</h3>

            <div class="review">
                <div class="review-avatar">JD</div>
                <div class="review-content">
                    <div class="review-header">
                        <span class="review-author">John Doe</span>
                        <span class="review-date">March 15, 2023</span>
                    </div>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="review-text">This product exceeded my expectations! The quality is outstanding and it
                        arrived sooner than expected. Will definitely purchase again.</p>
                </div>
            </div>

            <div class="review">
                <div class="review-avatar">AS</div>
                <div class="review-content">
                    <div class="review-header">
                        <span class="review-author">Alice Smith</span>
                        <span class="review-date">February 28, 2023</span>
                    </div>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <p class="review-text">Very good product overall. Works exactly as described. The only reason
                        I'm
                        not giving 5 stars is that the color was slightly different than shown in the pictures.</p>
                </div>
            </div>

            <div class="review">
                <div class="review-avatar">RJ</div>
                <div class="review-content">
                    <div class="review-header">
                        <span class="review-author">Robert Johnson</span>
                        <span class="review-date">January 10, 2023</span>
                    </div>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="review-text">Great value for the price. I've been using it daily for two months now
                        and
                        it's holding up well. Delivery was fast and packaging was secure.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Thumbnail click functionality
        // document.querySelectorAll('.product-thumbnail').forEach(thumbnail => {
        //     thumbnail.addEventListener('click', function() {
        //         const mainImage = document.querySelector('.product-main-image');
        //         const tempSrc = mainImage.src;
        //         mainImage.src = this.src;
        //         this.src = tempSrc;
        //     });
        // });
    </script>
    @vite(['resources/js/cart/favouret.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.querySelector('.quantity-input');
            const minusBtn = document.querySelector('.quantity-btn.minus');
            const plusBtn = document.querySelector('.quantity-btn.plus');
            const maxQuantity = parseInt(quantityInput.getAttribute('max'));

            // Update button states initially
            updateButtonStates();

            // Minus button click handler
            minusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                    updateButtonStates();
                }
            });

            // Plus button click handler
            plusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value < maxQuantity) {
                    quantityInput.value = value + 1;
                    updateButtonStates();
                }
            });

            // Input change handler
            quantityInput.addEventListener('change', function() {
                let value = parseInt(quantityInput.value);
                if (isNaN(value) || value < 1) {
                    quantityInput.value = 1;
                } else if (value > maxQuantity) {
                    quantityInput.value = maxQuantity;
                }
                updateButtonStates();
            });

            function updateButtonStates() {
                const value = parseInt(quantityInput.value);
                minusBtn.disabled = value <= 1;
                plusBtn.disabled = value >= maxQuantity;

                // Sync with hidden input in the Buy Now form
                const hiddenField = document.querySelector('.quantity-field');
                if (hiddenField) {
                    hiddenField.value = value;
                }
            }
        });
    </script>
</body>

</html>
