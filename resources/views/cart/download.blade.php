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
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a0ca3;
            --text-dark: #2c3e50;
            --gray-medium: #bdc3c7;
            --gray-dark: #7f8c8d;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            font-size: 28px;
            color: var(--primary-dark);
            margin: 0 0 5px 0;
        }

        .invoice-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .meta-box {
            flex: 1;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
            margin: 0 10px;
        }

        .meta-box:first-child {
            margin-left: 0;
        }

        .meta-box:last-child {
            margin-right: 0;
        }

        .meta-box h3 {
            margin-top: 0;
            color: var(--primary-dark);
            font-size: 16px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px;
        }

        .meta-item {
            margin: 8px 0;
            font-size: 14px;
        }

        .meta-item strong {
            display: inline-block;
            width: 100px;
            color: var(--gray-dark);
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }

        .invoice-table thead {
            background-color: var(--primary-color);
            color: white;
        }

        .invoice-table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 500;
        }

        .invoice-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .invoice-table tr:last-child td {
            border-bottom: none;
        }

        .text-right {
            text-align: right;
        }

        .total-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .total-box {
            width: 300px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 15px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }

        .total-row.grand-total {
            font-weight: bold;
            font-size: 18px;
            border-top: 1px solid var(--border-color);
            padding-top: 12px;
            margin-top: 12px;
        }

        .invoice-footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            font-size: 12px;
            color: var(--gray-dark);
            text-align: center;
        }

        .thank-you {
            text-align: center;
            margin: 30px 0;
            font-style: italic;
            color: var(--primary-dark);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        @page {
            size: A4;
            margin: 1cm;
        }

        @media print {
            body {
                padding: 0;
            }

            .invoice-container {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="logo">
                YourStore
            </div>
            <div class="invoice-title">
                <h1>INVOICE</h1>
                <p>#{{ $data->payment_id }}</p>
                <p>Issued: {{ $data->created_at->format('F j, Y') }}</p>
                <p>Due: {{ $data->created_at->addDays(7)->format('F j, Y') }}</p>
            </div>
        </div>

        <div class="invoice-meta">
            {{-- <div class="meta-box">
                <h3>Bill To</h3>
                <div class="meta-item"><strong>Name:</strong> {{ $order->customer->name }}</div>
                <div class="meta-item"><strong>Email:</strong> {{ $order->customer->email }}</div>
                <div class="meta-item"><strong>Phone:</strong> {{ $order->customer->phone ?? 'N/A' }}</div>
            </div> --}}
            <div class="meta-box">
                <h3>Payment</h3>
                <div class="meta-item"><strong>Method:</strong> {{ ucfirst($data->currency) }}</div>
                <div class="meta-item"><strong>Status:</strong>
                    <span class="status-badge status-{{ strtolower($data->status) }}">{{ $data->status }}</span>
                </div>
                <div class="meta-item"><strong>Transaction ID:</strong> {{ $data->payment_id ?? 'N/A' }}</div>
            </div>
            {{-- <div class="meta-box">
                <h3>Shipping</h3>
                <div class="meta-item"><strong>Tracking ID:</strong> {{ $order->tracking_id ?? 'Pending' }}</div>
                <div class="meta-item"><strong>Carrier:</strong> {{ $order->shipping_carrier ?? 'Standard' }}</div>
                <div class="meta-item"><strong>Est. Delivery:</strong>
                    {{ $order->estimated_delivery ?? $order->created_at->addDays(5)->format('F j, Y') }}
                </div>
            </div> --}}
        </div>

        {{-- <table class="invoice-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="text-right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

        {{-- <div class="total-section">
            <div class="total-box">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Shipping:</span>
                    <span>${{ number_format($order->shipping_cost, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Tax:</span>
                    <span>${{ number_format($order->tax_amount, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Discount:</span>
                    <span>-${{ number_format($order->discount_amount, 2) }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>Total:</span>
                    <span>${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div> --}}

        <div class="thank-you">
            Thank you for your business! We appreciate your trust in us.
        </div>

        <div class="invoice-footer">
            <p>YourStore Inc. • 123 Business Ave, City, Country • contact@yourstore.com</p>
            <p>VAT Number: GB123456789 • Terms & Conditions apply</p>
        </div>
    </div>
</body>

</html>
