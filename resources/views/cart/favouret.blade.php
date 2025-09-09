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
    @vite(['resources/css/cart/favouret.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Document</title>
</head>

<body>
    <!-- Header Section (same as your main page) -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-laptop-code"></i>
                <span>TechShop</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="{{ route('cart_items') }}">Products</a></li>
                    <li><a href="#" class="active">Favorites</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                {{-- <div class="search-box">
                    <form action="#" method="GET" class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search products..." name="search">
                    </form>
                </div> --}}
                <div class="cart-wrapper">
                    {{-- <a href="{{ route('cart_data') }}" style="text-decoration: none">
                        <button class="cart-btn">
                            <i class="fas fa-shopping-cart cart-icon"></i>
                            @if ($total > 0)
                                <span class="notification-badge">{{ $total }}</span>
                            @endif
                        </button>
                    </a> --}}
                </div>
            </div>
        </div>
    </header>

    <!-- Main Favorites Content -->
    <main class="favorites-main">
        <div class="favorites-container">
            <div class="favorites-header">
                <h1><i class="fas fa-heart"></i> Your Favorites</h1>
                <a href="{{ route('clear_faviouret') }}" style="text-decoration: none">
                    <button style="cursor: pointer; padding: 7px; border: none; border-radius: 10px;">Clear</button>
                </a>
                {{-- <p class="favorites-count">{{ count($favorites) }} items</p> --}}
            </div>

            @if (count($favorites) > 0)
                <div class="favorites-grid">
                    @foreach ($favorites as $product)
                        <div class="favorite-product-card">
                            <div class="product-image-container">
                                <img src="{{ asset('storage/Cartitems/' . $product->image) }}" alt="issue">
                                <button class="remove-favorite" data-product-id="{{ $product->id }}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="product-details">
                                <h3>{{ $product['name'] }}</h3>
                                <div class="price-stock">
                                    <span class="price">${{ $product->price }}</span>
                                    @if ($product['quantity'] > 0)
                                        <span class="in-stock">In Stock</span>
                                    @else
                                        <span class="out-stock">Out of Stock</span>
                                    @endif
                                </div>
                                <a href="{{ route('add_to' , $product->id) }}" style="text-decoration: none">
                                    <button class="add-to-cart" {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                        <i class="fas fa-shopping-cart"></i>
                                        Add to Cart
                                    </button></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-favorites">
                    <i class="far fa-heart"></i>
                    <h2>Your favorites list is empty</h2>
                    <p>Browse our products and add your favorites!</p>
                    <a href="{{ route('cart_items') }}" class="browse-btn">Browse Products</a>
                </div>

            @endif
        </div>
    </main>
    @vite(['resources/js/cart/single_remove_favouret.js'])
</body>

</html>
