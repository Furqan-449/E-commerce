<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cart\AddToCart;
use App\Models\Stripe\Revenue;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentController extends Controller
{
    //
    public function checkout()
    {
        session()->forget('total_amount');
        return view('checkout');
    }

    public function showCheckoutForm()
    {
        $amount = session()->get('total_amount');
        if ($amount) {
            $amountToCharge =  (int) round($amount * 100);
            session()->forget('total_amount');
        } else {
            $cartController = new AddToCart; // your secure backend method
            $total = $cartController->calculateCartTotal();
            $amountToCharge =  (int) round($total['totalamount'] * 100); // Stripe needs amount in cents
            session()->forget('total_amount');
        };
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            "amount" =>  $amountToCharge, // amount in cents ($10.00)
            "currency" => "usd",
            'metadata' => [
                'user_id' => Auth::guard('endusers')->id(),
                'description' => 'from  user side',
                // 'order_id' => uniqid(), // optional
            ],
        ]);
        session()->forget('total_amount');
        return view('cart.stripe_payment', [
            'clientSecret' => $paymentIntent->client_secret,
            'amount' =>   number_format($amountToCharge / 100, 2),
        ]);

        // return back()->with('success', 'Payment successful!');
    }

    public function paymentresponse(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'id' => 'required|string',
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'status' => 'required|string',
        ]);

        $userId = Auth::guard('endusers')->id();
        if (!$userId) {
            return response()->json([
                'error' => 'User not authenticated.'
            ], 401);
        }

        $revenue = new Revenue();
        $revenue->payment_id = $validated['id'];
        // If amount is in cents, convert to dollars. If already in dollars, remove the division.
        $revenue->amount = is_numeric($validated['amount']) && $validated['amount'] > 1000 ? $validated['amount'] / 100 : $validated['amount'];
        $revenue->currency = $validated['currency'];
        $revenue->status = $validated['status'];
        $revenue->payment_by = $userId;
        $revenue->save();
        return response()->json([
            'done' => true,
            'message' => 'Payment recorded successfully.'
        ], 200);
    }

    public function paymentthanks()
    {
        // $trackid = $request->id;
        $thanks = Revenue::where('payment_by', Auth::guard('endusers')->id())
            ->latest('created_at')->first();
        if (!$thanks) {
            return redirect()->route('home')->with('error', 'Unauthorized or invalid payment.');
        }
        return view('cart.thanks', ['thanks' => $thanks]);
    }

    public function download()
    {
        $data = Revenue::where('payment_by', Auth::guard('endusers')->id())
            ->latest('created_at')->first();

        $pdf = Pdf::loadView('cart.download', ['data' => $data]);
        return $pdf->download('my-report.pdf');
    }
}
