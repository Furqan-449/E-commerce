<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart\Cartitem;
use App\Models\Categories\Categorie;
use App\Models\Favouret\FavouretItems;
use App\Models\Variant\ImageVariant;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CartItems extends Controller
{
    //
    public function cart_items()
    {
        $cart_item = Item::allitems();
        // $total = Cartitem::count();
        // $category = Categorie::get();
        return view("cart.cartitems", ["data" => $cart_item]);
    }

    public function profile()
    {
        return view('cart.profile');
    }
    public function product_search(Request $request)
    {
        $valid = $request->validate([
            'search' => 'required | string',
        ]);
        $find = Item::productsearch($valid['search'])->get();
        // // $total = Cartitem::count();
        // // $category = Categorie::get();
        return view("cart.cartitems", ["data" => $find]);
    }

    public function category_product($id)
    {
        $cart_item = Item::categoryproduct($id)->get();
        // $total = Cartitem::count();
        // $category = Categorie::get();
        return view("cart.cartitems", ["data" => $cart_item]);
    }

    public function single_item_show($id)
    {
        $item = Item::findOrFail($id);
        $findvariant = ImageVariant::where('image_id', $item->id)->get();
        $isFavorite = false;
        if (Auth::guard('endusers')->check()) {
            $isFavorite = FavouretItems::where('user_id', Auth::guard('endusers')->id())
                ->where('item_id', $id)
                ->exists();
        }
        return view('cart.single_item_show', ['product' => $item, 'isFavorite' => $isFavorite, 'findvariant' => $findvariant]);
    }
    public function favourite($productId)
    {
        // if (!Auth::guard('endusers')->check()) {
        //     return redirect()->route('login_page');
        // }
        $userlog = Auth::guard('endusers')->user();
        $find = FavouretItems::where('item_id', $productId)
            ->where('user_id', $userlog->id)->first();
        if ($find) {
            $find->delete();
            return response()->json(['is_favorite' => false]);
        }
        $item = new FavouretItems();
        $item->item_id = $productId;
        $item->user_id = Auth::guard('endusers')->id();
        $item->save();
        return response()->json(['is_favorite' => true]);
    }

    public function favourite_items()
    {
        $products = FavouretItems::where('user_id', Auth::guard('endusers')->id())->get();
        // dd($products);
        // Extract item IDs from the collection
        $itemIds = $products->pluck('item_id');
        $find = Item::whereIn('id', $itemIds)->get();
        // dd($find);
        return view('cart.favouret', ['favorites' => $find, 'products' => $products]);
    }

    public function remove_one_faviouret($id)
    {
        $find = FavouretItems::where('item_id', $id)->where('user_id', Auth::guard('endusers')->id())->first();
        if ($find) {
            $find->delete();
            return response()->json(['success' => true, 'message' => 'Item removed from favorites']);
        }
        return response()->json(['success' => false, 'message' => 'Item not found'], 404);
    }
    public function clear_faviouret()
    {
        $find = FavouretItems::where('user_id', Auth::guard('endusers')->id());
        $find->truncate();
        return redirect()->route('cart_items');
    }
}
