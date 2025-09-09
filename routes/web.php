<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashBoard;
use App\Http\Controllers\Invoices;
use App\Http\Controllers\Clients;
use App\Http\Controllers\Reports;
use App\Http\Controllers\Items;
use App\Http\Controllers\Cart\CartItems;
use App\Http\Controllers\Cart\AddToCart;
use App\Http\Controllers\Auth\Admins;
use App\Http\Controllers\Categories\Category;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\EndUser;
use App\Http\Controllers\EndUser\EnUser;
use App\Http\Controllers\Varient\ImageVarient;
use App\Http\Controllers\Stripe\StripePaymentController;
use App\Http\Controllers\Email\EmailController;

// Route::get('/', fn() => view('pages.dashboard.dashboard'));
Route::get('/dashboard', [DashBoard::class, 'dashpage'])->name("dashboard");
Route::get('/newinvoice', [DashBoard::class, 'new_invoice'])->name("invoice.create");
Route::get('/invoices', [Invoices::class, 'invoices'])->name("invoices");
Route::get('/new_invoice', [Invoices::class, 'new_invoice'])->name("new_invoice");

// clients Route
Route::controller(Clients::class)->group(function () {
    Route::get('/clients', 'clients')->name("clients");
    Route::get('/addclient', 'add_client')->name("addclient");
    Route::get('/search-client', 'search_cliet')->name("search_cliet");
    Route::post('/client_data', 'add_data');
    Route::get('/editclient/{id}', 'edit_client')->name("editclient");
    Route::post('/editdata/{id}', 'edit_data')->name("editdata");
    Route::get('/deleteclient/{id}', 'delete_client')->name("deleteclient");
});

// items Route
Route::controller(Items::class)->group(function () {
    Route::get('/items', 'all_items')->name("items");
    Route::get('/search_items', 'search_items')->name("search_item");
    Route::get('/item_form', 'item_form')->name("item_form");
    Route::post('/add_item', 'add_item')->name("add_item");
    Route::get('/edit_item/{id}', 'edit_item')->name("edit_item");
    Route::post('/update_item/{id}', 'update_item')->name("update_item");
    Route::get('/delete_item/{id}', 'delete_item')->name("delete_item");
    Route::get('/cancle', 'cancle')->name("cancle");
    Route::get('/show_sub_category/{id}', 'show_sub_category')->name("show_sub_category");
});



Route::get('/reports', [Reports::class, 'Reports'])->name("reports");


// Route::get("/", [CartItems::class, "cart_items"])->name("/");

// Admin, Login, Sing up Route
Route::controller(Admins::class)->prefix(("admin"))->group(function () {
    Route::get("/sign_up", "index")->name("sign_up");
    Route::get("/login", "login")->name("login");
    Route::post("/data/register", "admin_register")->name("register");
    Route::post("/data/login", "login_success")->name("admin_login_success");
    Route::get("/logout", "logout")->name("logout");
    Route::get("/delete_account", "delete_account")->name("delete_account");
});

Route::get('/', function () {
    return redirect()->route('login');
});

// Cart Route
Route::controller(CartItems::class)->group(function () {
    Route::get("/cart_items",  "cart_items")->name("cart_items");
    Route::get("/product_search",  "product_search")->name("product_search");
    Route::get("/category_product/{id}",  "category_product")->name("category_product");
    Route::post("/favourite/{id}",  "favourite")->name("favourite")->middleware(EndUser::class);
    Route::get("/favourite_items",  "favourite_items")->name("favourite_items");
    Route::get("/clear_faviouret",  "clear_faviouret")->name("clear_faviouret");
    Route::get("/remove_one_faviouret/{id}",  "remove_one_faviouret")->name("remove_one_faviouret");
    Route::get("/single_item_show/{id}",  "single_item_show")->name("single_item_show");
    Route::get("/profile",  "profile")->name("profile");
});

// Add To Cart Route
Route::controller(AddToCart::class)->group(function () {
    Route::get("/cart_data", "cart_data")->name("cart_data");
    Route::get("/check_out", "check_out")->name("check_out");
    Route::get("/add_to/{id}", "add_to")->name("add_to")->middleware(EndUser::class);
    Route::post("/update_quantity/{id}", "quantity_update")->name("update_quantity");
    Route::post("/quantity_decrease/{id}", "quantity_decrease")->name("quantity_decrease");
    Route::post("/man_update_quantity/{id}", "man_update_quantity")->name("man_update_quantity");
    Route::get("/cart_item_delete/{id}", "cart_item_delete")->name("cart_item_delete");
    Route::post("/discount", "discount")->name("discount");
    Route::get("/clear_cart", "clear_cart")->name("clear_cart");
    Route::post("/buy_single_item/{id}", "buy_single_item")->name("buy_single_item");
});


// Categories Route
Route::controller(Category::class)->group(function () {
    Route::get('/categories',  'all_categories')->name('categories');
    Route::post('/add_category_name',  'add_category_name')->name('add_category_name');
    Route::get('/sear_cat_name',  'sear_cat_name')->name('sear_cat_name');
    Route::get('/get_categories',  'get_categories')->name('get_categories');
    Route::get('/get_edit_category/{id}',  'get_edit_category')->name('get_edit_category');
    Route::post('/edit_category',  'edit_category')->name('edit_category');
    Route::get('/sub_category/{id}',  'sub_category')->name('sub_category');
    Route::post('/add_subcategory',  'add_sub_category')->name('add_sub_category');
    Route::get('/delete_category/{id}', 'delete_category')->name('delete_category');
    Route::get('/delete_sub_category/{id}', 'delete_sub_category')->name('delete_sub_category');
})->middleware(ValidUser::class);


// Route::get('checkout', [StripePaymentController::class, 'checkout']);
Route::post('/checkout', [StripePaymentController::class, 'showCheckoutForm'])->name('checkout.form');

// Route::post('payment', [StripePaymentController::class, 'processPayment'])->name('payment');
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('payment/success',  'processPayment')->name('payment.success');
    Route::post('payment/response',  'paymentresponse')->name('payment.response');
    Route::get('payment/thanks/{id}',  'paymentthanks')->name('payment.thanks');
    Route::get('/download',  'download')->name('download');
});

// End User Route
Route::controller(EnUser::class)->group(function () {
    Route::get('/google_login', 'google_login')->name('google_login');
    Route::get('/google_redirect', 'google_redirect')->name('google_redirect');
    Route::get('/login_page', 'login_page')->name('login_page');
    Route::get('/singup_page', 'singup_page')->name('singup_page');
    Route::post('/login_success', 'login_success')->name('login_success');
    Route::post('/singup', 'singup')->name('singup');
    Route::get('/user_logout', 'user_logout')->name('user_logout');
    Route::get('/forget_password', 'forget_password')->name('forget_password');
    Route::post('/forget_password_reset_link', 'forget_password_reset_link')->name('forget_password_reset_link');
    Route::get('/password/reset/{token}', 'password_reset')->name('password.reset');
    Route::post('/password/update', 'password_update')->name('password.update');
});



Route::get("/send_email", [EmailController::class, "send_email"])->name("send_email");
Route::get('/variant_image/{id}', [ImageVarient::class, 'variant_image'])->name('variant_image');
Route::get('/detail', function () {
    return view('pages/invoices/detail');
});
