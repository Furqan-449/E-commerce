<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/cart/thanks.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="thank-you-container">
        <div class="thank-you-header">
            <div class="thank-you-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="thank-you-title">Thank You For Your Order!</h1>
            <p class="thank-you-subtitle">Your order has been received and is being processed</p>
        </div>

        <div class="order-summary">
            <h3>Order Summary</h3>
            <div class="order-details">
                <div class="order-detail">
                    <strong>Order Number:</strong>
                    <span>#{{ $thanks->payment_id }}</span>
                </div>
                <div class="order-detail">
                    <strong>Date:</strong>
                    <span>{{ $thanks->created_at->format('F j, Y') }}</span>
                </div>
                <div class="order-detail">
                    <strong>Total:</strong>
                    <span>${{ number_format($thanks->amount, 2) }}</span>
                </div>
                <div class="order-detail">
                    <strong>Payment Method:</strong>
                    {{-- <span>{{ ucfirst($thanks->payment_method) }}</span> --}}
                </div>
                <div class="order-detail">
                    <strong>Status:</strong>
                    <span class="status-badge">{{ ucfirst($thanks->status) }}</span>
                </div>
                <div class="order-detail">
                    <strong>Tracking ID:</strong>
                    <span>{{ $thanks->tracking_id ?? 'Pending' }}</span>
                </div>
            </div>
        </div>

        <div class="download-section">
            <p>You can download your order invoice below:</p>
            <a href="{{ route('download') }}" class="download-btn" style="text-decoration: none">
                <i class="fas fa-download"></i> Download Invoice
            </a>
        </div>

        <div class="action-buttons">
            {{-- <a href="{{ route('track.order', $order->id) }}" class="download-btn"> --}}
            {{-- <i class="fas fa-truck"></i> Track Order --}}
            {{-- </a> --}}
            {{-- <a href="{{ route('home') }}" class="continue-shopping"> --}}
            {{-- <i class="fas fa-shopping-bag"></i> Continue Shopping --}}
            {{-- </a> --}}
        </div>
    </div>
</body>

</html>
