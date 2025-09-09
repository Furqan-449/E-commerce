<?php

namespace App\Providers;

use App\Models\Cart\Cartitem;
use App\Models\Categories\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CartItemsViewProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->app->booted(function () {
            View::composer("cart.cartitems", function ($view) {
                $total = 0;
                if (Auth::guard('endusers')->check()) {
                    $total = Cartitem::where("user_id", Auth::guard('endusers')->id())->count();
                }
                $view->with("total", $total);
                $view->with("categories", Categorie::all());
            });
            View::composer("cart.single_item_show", function ($view) {

                $total = 0;
                if (Auth::guard('endusers')->check()) {
                    $total = Cartitem::where("user_id", Auth::guard('endusers')->id())->count();
                }
                $view->with("total", $total);
            });
        });
    }
}
