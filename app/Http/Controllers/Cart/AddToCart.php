<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart\Cartitem;
use App\Models\Cart\Coupn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddToCart extends Controller
{
    // protected $total;
    // protected $totalamount = 0;
    //
    public function calculateCartTotal()
    {
        $total = 0;
        $totalamount = 0;
        $singletotalamount = 0;
        $collect = Cartitem::where('user_id', Auth::guard('endusers')->id())->get();
        foreach ($collect as $item) {
            $total += $item->price * $item->quantity;
        }
        $discount = ($total * 2) / 100;
        $tax = ($total * 5) / 100;
        $shipping = 1.2;
        $totalamount = $total - $discount + $tax + $shipping;
        return [
            'total' => $total,
            'totalamount' => $totalamount,
            'discount' => $discount,
            'tax' => $tax,
            'shipping' => $shipping,
            'singletotalamount' => $singletotalamount
        ];
    }
    public function cart_data()
    {
        $cart_data = Cartitem::where('user_id', Auth::guard('endusers')->id())->get();
        $total_price = 0;
        foreach ($cart_data as $item) {
            $total_price += $item->price * $item->quantity;
        }
        return view("cart.show_in_cart", ["cart_data" => $cart_data, "subtotal" => $total_price]);
    }

    public function check_out()
    {
        session()->forget('total_amount');
        session()->forget('single_item');
        $collect = Cartitem::where('user_id', Auth::guard('endusers')->id())->get();
        $total = $this->calculateCartTotal();

        return view("cart.check_out", ['singledata' => false, 'data' => $collect, 'total' => $total['total'], 'discount' => $total['discount'], 'tax' => $total['tax'], 'shipping' => $total['shipping'], 'totalamount' => $total['totalamount']]);
    }


    public function add_to($id)
    {
        if (Auth::guard('endusers')->user()) {
            $cart = Item::findOrFail($id);
            $check = Cartitem::where("item_id", $id)->where('user_id', Auth::guard('endusers')->id())->first();
            if ($check) {
                return redirect()->route("cart_items")->with('success', 'item present in cart!');
            }
            if ($cart->quantity <= 0) {
                return redirect()->route('cart_items');
            }
            $to_cart = new Cartitem();
            $to_cart->item_id = $cart->id;
            $to_cart->name = $cart->name;
            $to_cart->price = $cart->price;
            $to_cart->user_id = Auth::guard('endusers')->id();
            $to_cart->quantity = 1;
            $image = "Items/" . $cart->image;
            $filename = basename($image);
            $new_path = "Cartitems/" . $filename;
            if (!Storage::disk('public')->exists('Cartitems')) {
                Storage::disk('public')->makeDirectory('Cartitems');
            }

            if (!Storage::disk('public')->exists($new_path)) {
                Storage::disk('public')->copy($image, $new_path);
            }

            // Storage::disk("public")->copy($image, $new_path);
            $to_cart->image = $filename;

            $to_cart->save();

            return redirect()->route("cart_items")->with("success", "item added to cart");
        }
        return redirect()->route('login_page');
    }


    public function quantity_update(Request $request, $id)
    {
        $cart = Cartitem::with('item')
            ->where('id', $id)
            ->where('user_id', Auth::guard('endusers')->id())
            ->firstOrFail();
        if ($cart->quantity < $cart->item->quantity) {
            $cart->increment("quantity"); // Increment the quantity by 1
            $cart->save();
        }
    }
    public function quantity_decrease(Request $request, $id)
    {
        $cart = Cartitem::where('id', $id)
            ->where('user_id', Auth::guard('endusers')->id())
            ->firstOrFail();
        if ($cart->quantity > 1) {
            $cart->decrement("quantity"); // decrement the quantity by 1
            $cart->save();
        }
    }

    public function discount(Request $request)
    {
        $isSingleItem = session()->get('single_item', false); // default to false
        if ($isSingleItem) {
            return response()->json(['error' => 'Invalid or expired code'], 403);
        }
        session()->forget('total_amount');

        $amount = $this->calculateCartTotal();
        $val = $request->validate([
            'discount' => 'required',
        ]);
        $code = $val['discount'];
        $find = Coupn::where('code', $code)
            ->where('get', 1)
            ->where('expire', '>', now())
            ->first();
        if (!$find) {
            return response()->json(['error' => 'Invalid or expired code'], 404);
        }
        if ($amount['totalamount'] > 100 && $amount['totalamount'] < 200) {
            if ($find->fixed_price == 0) {
                // $find->get = 0;
                // $find->user_id = Auth::id();
                // $find->save();
                $discount = $find->discount;
                $after_discount = $amount['totalamount'] - ($amount['totalamount'] * $find->discount) / 100;

                session()->put('total_amount', $after_discount);
                return response()->json(['discount' => $after_discount, 'discount_get' => $discount], 200);
            } else {
                return response()->json(['discount' => 0], 400);
            }
        }
        if ($amount['totalamount'] > 200) {
            if ($find->discount == 0 && $find->fixed_price != 0) {
                // $find->get = 0;
                // $find->save();
                $discount = $find->fixed_price;
                $after_discount = $amount['totalamount'] - $find->fixed_price;

                session()->put('total_amount', $after_discount);
                return response()->json(['fixed' => $after_discount, 'fixed_discount' => $discount], 200);
            } else {
                return response()->json(['fixed' => 0], 400);
            }
        }
        return response()->json(['discount' => $find->discount], 200);
    }
    public function man_update_quantity(Request $request, $id)
    {
        $quantity = $request->input('quantity');
        $cart = Cartitem::with('item')
            ->where('id', $id)
            ->where('user_id', Auth::guard('endusers')->id())
            ->firstOrFail();
        // $stock = Item::findOrFail($cart->item_id);
        if ($quantity <= 0) {
            $cart->delete();
            return response()->json([
                'status' => 'deleted',
                'message' => 'Item removed from cart'
            ]);
            // return redirect()->route('cart_data')->with('delete', 'item deleted!');
        }
        if ($quantity < $cart->item->quantity) {
            $cart->quantity = $quantity; // Increment or decrement the quantity
            $cart->save();
        }
    }

    public function clear_cart()
    {
        Cartitem::truncate();
        return redirect()->route('cart_data')->with('delete', 'cart clear!');
    }
    public function cart_item_delete($id)
    {
        $find = CartItem::findOrFail($id);
        $find->delete();
        return redirect()->route('cart_data')->with('delete', 'item deleted!');
    }


    public function buy_single_item(Request $request, $id)
    {
        $quantity = (int) $request->input('quantity', 1);
        if (Auth::guard('endusers')->user()) {
            $cart = Item::findOrFail($id);
            // $check = Cartitem::where("item_id", $id)->first();
            if (!$cart) {
                return redirect()->back();
            }
            if ($cart->quantity <= 0) {
                return redirect()->route('cart_items');
            }
            $amount = $cart->price * $quantity;
            $tax = ($amount * 2) / 100;
            $shipping = ($amount * 5) / 100;
            $totalamount = $amount + $tax + $shipping;
            session(['total_amount' => $totalamount]);
            session()->put('single_item', true);
            // $total = $this->calculateCartTotal();
            // dd($quantity);
            return view("cart.check_out", [
                'data' => false,
                'singledata' =>  $cart,
                'quantity' => $quantity,
                'total' => $amount,
                'discount' => 0,
                'tax' => $tax,
                'shipping' => $shipping,
                'totalamount' => $totalamount
            ]);
        }
        return redirect()->route('login_page');
    }
}
