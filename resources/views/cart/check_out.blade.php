<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/cart/check_out.css', 'resources/js/app.js'])
    <script src="https://js.stripe.com/v3/"></script>
    <title>Document</title>
</head>

<body>
    <div class="checkout-container">
        <div class="checkout-header">
            <h1 class="checkout-title">Checkout</h1>
            {{-- <div class="checkout-steps">
                <div class="step completed">
                    <span class="step-number"><i class="fas fa-check"></i></span>
                    <span>Cart</span>
                </div>
                <div class="step active">
                    <span class="step-number">2</span>
                    <span>Information</span>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <span>Payment</span>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span>Confirmation</span>
                </div>
            </div> --}}
        </div>

        <div class="checkout-form">
            <form id="checkoutForm">
                <section class="shipping-section">
                    <h2 class="section-title">
                        <i class="fas fa-truck"></i> Shipping Information
                    </h2>

                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" id="email" name="email" />
                    </div>

                    <div class="form-group">
                        <label class="checkbox-group">
                            <input type="checkbox" id="createAccount" />
                            <span>Create an account for faster checkout next time</span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="shippingFirstName" class="required">First Name</label>
                        <input type="text" id="shippingFirstName" name="shippingFirstName" />
                    </div>

                    <div class="form-group">
                        <label for="shippingLastName" class="required">Last Name</label>
                        <input type="text" id="shippingLastName" name="shippingLastName" />
                    </div>

                    <div class="form-group">
                        <label for="shippingAddress1" class="required">Address</label>
                        <input type="text" id="shippingAddress1" name="shippingAddress1"
                            placeholder="Street address" />
                    </div>

                    <div class="form-group">
                        <input type="text" id="shippingAddress2" name="shippingAddress2"
                            placeholder="Apt, suite, etc. (optional)" />
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="shippingCountry" class="required">Country</label>
                            <select id="shippingCountry" name="shippingCountry">
                                <option value="">Select country</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="UK">United Kingdom</option>
                                <!-- More countries would be added here -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="shippingCity" class="required">City</label>
                            <input type="text" id="shippingCity" name="shippingCity" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="shippingState" class="required">State/Province</label>
                            <select id="shippingState" name="shippingState">
                                <option value="">Select state</option>
                                <option value="united">United</option>
                                <option value="pakistan">Pakistan</option>
                                <!-- States would be populated based on country -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="shippingZip" class="required">ZIP/Postal code</label>
                            <input type="text" id="shippingZip" name="shippingZip" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="shippingPhone">Phone (optional)</label>
                        <input type="tel" id="shippingPhone" name="shippingPhone" />
                    </div>
                </section>

                {{-- <section class="billing-section">
                    <h2 class="section-title">
                        <i class="fas fa-file-invoice-dollar"></i> Billing Information
                    </h2>

                    <div class="form-group">
                        <label class="checkbox-group">
                            <input type="checkbox" id="sameAsShipping" checked />
                            <span>Same as shipping information</span>
                        </label>
                    </div>

                    <div id="billingFields" style="display: none">
                        <div class="form-group">
                            <label for="billingFirstName" class="required">First Name</label>
                            <input type="text" id="billingFirstName" name="billingFirstName" />
                        </div>

                        <div class="form-group">
                            <label for="billingLastName" class="required">Last Name</label>
                            <input type="text" id="billingLastName" name="billingLastName" />
                        </div>

                        <div class="form-group">
                            <label for="billingAddress1" class="required">Address</label>
                            <input type="text" id="billingAddress1" name="billingAddress1"
                                placeholder="Street address" />
                        </div>

                        <div class="form-group">
                            <input type="text" id="billingAddress2" name="billingAddress2"
                                placeholder="Apt, suite, etc. (optional)" />
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="billingCountry" class="required">Country</label>
                                <select id="billingCountry" name="billingCountry">
                                    <option value="">Select country</option>
                                    <option value="US">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="UK">United Kingdom</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="billingCity" class="required">City</label>
                                <input type="text" id="billingCity" name="billingCity" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="billingState" class="required">State/Province</label>
                                <select id="billingState" name="billingState">
                                    <option value="">Select state</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="billingZip" class="required">ZIP/Postal code</label>
                                <input type="text" id="billingZip" name="billingZip" />
                            </div>
                        </div>
                    </div>
                </section> --}}

                {{-- <section class="payment-section">
                    <h2 class="section-title">
                        <i class="fas fa-credit-card"></i> Payment Method
                    </h2>

                    <div class="payment-methods">
                        <label class="payment-method selected">
                            <input type="radio" name="paymentMethod" value="creditCard" checked />
                            <i class="fas fa-credit-card payment-icon"></i>
                            <span>Credit Card</span>
                        </label>

                        <label class="payment-method">
                            <input type="radio" name="paymentMethod" value="paypal" />
                            <i class="fab fa-cc-paypal payment-icon"></i>
                            <span>PayPal</span>
                        </label>

                        <label class="payment-method">
                            <input type="radio" name="paymentMethod" value="applePay" />
                            <i class="fab fa-cc-apple-pay payment-icon"></i>
                            <span>Apple Pay</span>
                        </label>
                    </div>

                    <div class="payment-details active" id="creditCardDetails">
                        <div class="form-group">
                            <label for="cardNumber" class="required">Card Number</label>
                            <input type="text" id="cardNumber" name="cardNumber"
                                placeholder="1234 5678 9012 3456" />
                        </div>

                        <div class="form-group">
                            <label for="cardName" class="required">Name on Card</label>
                            <input type="text" id="cardName" name="cardName" />
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cardExpiry" class="required">Expiration Date</label>
                                <input type="text" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" />
                            </div>

                            <div class="form-group">
                                <label for="cardCvv" class="required">CVV</label>
                                <input type="text" id="cardCvv" name="cardCvv" placeholder="123" />
                            </div>
                        </div>
                    </div>

                    <div class="payment-details" id="paypalDetails">
                        <p>
                            You'll be redirected to PayPal to complete your purchase
                            securely.
                        </p>
                    </div>

                    <div class="payment-details" id="applePayDetails">
                        <p>Complete your purchase using Apple Pay on the next step.</p>
                    </div>
                </section> --}}
            </form>
        </div>

        <div class="order-summary">
            <h2 class="section-title">
                <i class="fas fa-receipt"></i> Order Summary
            </h2>

            <div class="order-items">
                <!-- Sample order items - these would be dynamically generated from cart -->
                @if ($data)
                    @foreach ($data as $proced)
                        <div class="order-item">
                            <img src="{{ asset('storage/Cartitems/' . $proced->image) }}" alt="Product"
                            class="order-item-img" />
                            <div class="order-item-details">
                                <div class="order-item-name">{{ $proced->name }}</div>
                                <div class="order-item-price">${{ $proced->price }} </div>
                                <div class="order-item-qty">Qty: {{ $proced->quantity }}</div>
                            </div>
                        </div>
                    @endforeach
                @elseif ($singledata)
                    <div class="order-item">
                        <img src="{{ asset('storage/items/' . $singledata->image) }}" alt="Product"
                            class="order-item-img" />
                        <div class="order-item-details">
                            <div class="order-item-name">{{ $singledata->name }}</div>
                            <div class="order-item-price">${{ $singledata->price }}</div>
                            <div class="order-item-qty">Qty: {{ $quantity }}</div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>$ {{ $total }}</span>
            </div>
            <div class="summary-row">
                <span>Discount</span>
                <span>$ {{ $discount }}</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span>${{ $shipping }}</span>
            </div>
            <div class="summary-row">
                <span>Tax</span>
                <span>${{ $tax }}</span>
            </div>
            <!-- Discount Code Checkbox & Input -->
            <div class="discount-container">
                <div class="checkbox-group">
                    <input type="checkbox" id="hasDiscount" onchange="toggleDiscount()">
                    <label for="hasDiscount">Apply Discount Code</label>
                </div>
                <div class="discount-dropdown" id="discountDropdown">
                    <div class="discount-input-group">
                        <input type="text" id="discountCode" placeholder="Enter your code" name="discount">
                        <button class="apply-discount-btn" id="button">Apply</button>
                    </div>
                    <div style="display: flex;justify-content:space-between">
                        <span class="discount-message" id="disme"></span>
                        <span class="discount-message" id="discountMessage"></span>
                    </div>

                </div>
            </div>
            <div class="summary-row summary-total">
                <span>Total</span>
                <span id="totalAmount">
                    ${{ $totalamount }}</span>
            </div>
            <form action="{{ route('checkout.form') }}" method="post" id="payment-form">
                @csrf
                {{-- <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ config('services.stripe.key') }}" data-amount="20000" data-name="Test Product"
                    data-description="Order Payment" data-currency="usd"></script> --}}
                <div id="card-element"></div>
                <button type="submit" class="place-order-btn">
                    <i class="fas fa-lock"></i> Place Order
                </button>
            </form>
            <a href="{{ route('cart_data') }}" class="back-to-cart">
                <i class="fas fa-arrow-left"></i> Back to Cart
            </a>
        </div>
    </div>
    @vite(['resources/js/cart/check_out.js']);
    {{-- <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const clientSecret = "{{ $clientSecret }}";

        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: '{{ Auth::guard('endusers')->user()->name }}'
                    }
                }
            }).then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                }
                //  else {
                //     if (result.paymentIntent.status === 'succeeded') {
                //         window.location.href = "{{ route('payment.success') }}";
                //     }
                // }
            });
        });
    </script> --}}
</body>

</html>
