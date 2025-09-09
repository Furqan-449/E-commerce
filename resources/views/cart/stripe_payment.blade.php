<!DOCTYPE html>
<html>

<head>
    <title>Stripe Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #32325d;
            max-width: 700px;
            /* More narrow for better centering */
            margin: 0 auto;
            padding: 40px 20px;
            background-color: #f6f9fc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            box-sizing: border-box;
            justify-content: center;
            /* Vertical centering */
        }

        h2 {
            color: #24b47e;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
            font-size: 28px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            text-align: center;
        }

        #payment-form {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        #payment-form:hover {
            box-shadow: 0 15px 30px rgba(50, 50, 93, 0.15), 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        #card-element {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            margin-bottom: 25px;
            background: white;
            transition: all 0.3s ease;
        }

        button {
            background: linear-gradient(to right, #24b47e, #38ef7d);
            color: white;
            border: none;
            padding: 16px 24px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        button:hover {
            background: linear-gradient(to right, #159570, #24b47e);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(50, 50, 93, 0.15), 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: translateY(0);
        }

        /* Stripe element focus state */
        .StripeElement--focus {
            border-color: #24b47e;
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        /* Stripe element invalid state */
        .StripeElement--invalid {
            border-color: #fa755a;
        }

        /* Loading state */
        .spinner {
            display: none;
            width: 30px;
            height: 30px;
            margin: 20px auto;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top-color: #24b47e;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Success message */
        .success-message {
            text-align: center;
            color: #24b47e;
            font-weight: 500;
            margin-top: 20px;
            display: none;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            body {
                padding: 20px 15px;
            }

            #payment-form {
                padding: 30px 20px;
            }

            h2 {
                font-size: 24px;
            }
        }

        /* Add a subtle animation on load */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #payment-form {
            animation: fadeInUp 0.5s ease-out;
        }
    </style>
</head>

<body>
    <div>
        <h2>Stripe Payment</h2>
        <p>Amount: ${{ $amount }}</p>

        <form id="payment-form">
            @csrf
            <div id="card-element"></div>
            <button type="submit">Pay</button>
        </form>
    </div>
    <script>
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
                } else {
                    if (result.paymentIntent.status === 'succeeded') {
                        console.log(result.paymentIntent.id)
                        console.log(result.paymentIntent.amount)
                        axios.post("/payment/response/", {
                            id: result.paymentIntent.id,
                            amount: result.paymentIntent.amount,
                            currency: result.paymentIntent.currency,
                            status: result.paymentIntent.status,
                        }).then((res) => {
                            // console.log(res)
                            if (res.data.done == true && res.status == 200) {
                                window.location.href = "/payment/thanks/" + result.paymentIntent.id;
                            }
                        }).catch((err) => {
                            console.log(err)
                        });
                    }
                }
            }).catch((error) => {
                console.log(error)
            });
        });
    </script>

</body>

</html>
