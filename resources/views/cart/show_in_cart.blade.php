<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/cart/show_in_cart.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="cart-container">
        <div class="page-header">
            <h1 class="page-title">Your Shopping Cart</h1>
            <a href="{{ route('cart_items') }}" class="continue-shopping">
                <i class="fas fa-arrow-left"></i>
                Continue Shopping
            </a>
        </div>
        @if (session('delete'))
            <div class="alert alert-danger"
                style="border: 1px solid #e74c3c; background: #fdecea; color: #e74c3c; padding: 10px; border-radius: 6px; text-align: center; width: 30%; margin:0px auto 10px auto; display: flex; justify-content:space-around">
                {{ session('delete') }}
            </div>
        @endif
        @if (count($cart_data) > 0)
            <div style="text-align: right; margin-bottom: 1rem;">
                <a href="{{route('clear_cart')}}" style="text-decoration: none">
                <button id="clear-cart" class="clear-cart-btn">
                    <i class="fas fa-trash"></i> Clear Cart
                </button></a>
            </div>
        @endif
        <!-- Check if cart has items -->
        @if (count($cart_data) > 0)
            <div class="cart-items">
                <div class="cart-header">
                    <div>Product</div>
                    <div>Price</div>
                    <div>Quantity</div>
                    <div>Total</div>
                    <div>Action</div>
                    <div></div>
                </div>

                @foreach ($cart_data as $item)
                    <div class="cart-item">
                        <div class="item-info">
                            <img src="{{ url('storage/Cartitems/', $item->image) }}" alt="{{ $item->name }}"
                                class="item-image" />
                            <div class="item-details">
                                <h3>{{ $item->name }}</h3>
                                <p>{{ $item->description }}</p>
                            </div>
                        </div>
                        <div class="item-price">${{ number_format($item->price, 2) }}</div>
                        <span style="display: none" class="item-id">{{ $item->id }}</span>
                        <div class="quantity-control">
                            <button class="quantity-btn minus-btn" type="button" onclick="decreasequan(this)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="quantity" data-price="{{ $item->price }}"
                                onchange="pricehandle(this)" value="{{ $item->quantity }}" min="1" />
                            <button class="quantity-btn plus-btn" type="button" onclick="increasequan(this)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-total">
                            $<span
                                class="item-total-value">{{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                        <a href="{{ route('cart_item_delete', $item->id) }}" style="text-decoration: none">
                            <button class="remove-item">
                                <i class="fas fa-trash"></i>
                            </button></a>
                    </div>
                @endforeach
            </div>

            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal-value" class="subtotal-value">${{ number_format($subtotal, 2) }}</span>
                </div>
                <a href="{{ route('check_out') }}" style="text-decoration: none">
                    <button class="checkout-btn">
                        <i class="fas fa-lock"></i>
                        Proceed to Checkout
                    </button></a>
            </div>
        @else
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added any items to your cart yet</p>
                <a href="{{ route('cart_items') }}" class="continue-shopping"
                    style="display: inline-flex; margin-top: 1rem">
                    <i class="fas fa-arrow-left"></i>
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>


    @vite(['resources/js/cart/show_in_cart.js', 'resources/js/app.js'])
</body>

</html>
