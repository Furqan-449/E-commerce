<?php

namespace App\Http\Controllers;

use App\Models\Stripe\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoard extends Controller
{
    //
    public function dashpage()
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $revenue = Revenue::get();
            $amount = 0;
            foreach ($revenue as $total) {
                $amount += $total->amount;
            }
            return view("pages/dashboard/dashboard", ['user' => $user, 'amount' => $amount]);
        } else {
            return redirect()->route('login')->with('dasherror', 'First you must be logged in');
        }
    }

    public function new_invoice()
    {
        return view("pages/invoices/create");
    }
}
