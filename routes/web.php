<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RajaOngkirController;


// Route untuk mendapatkan daftar provinsi
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);

// Route untuk mendapatkan daftar kota berdasarkan provinsi
Route::get('/cities/{provinceId}', [RajaOngkirController::class, 'getCities']);

// Route untuk cek ongkir
Route::post('/check-shipping-cost', [RajaOngkirController::class, 'checkShippingCost']);



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route untuk mendapatkan daftar provinsi
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);

// Route untuk mendapatkan daftar kota berdasarkan provinsi
Route::get('/cities/{provinceId}', [RajaOngkirController::class, 'getCities']);

// Route untuk cek ongkir
Route::post('/check-shipping-cost', [RajaOngkirController::class, 'checkShippingCost']);


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Auth::routes();

// Route untuk dashboard (hanya bisa diakses setelah login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route lainnya yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile'); // Contoh route untuk halaman profile
    });

    Route::get('/settings', function () {
        return view('settings'); // Contoh route untuk halaman settings
    });
    // routes/web.php
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});




Route::middleware(['admin'])->group(function() {
	Route::get('/product/index', [ProductController::class, 'index_product'])->name('index_product');
	Route::get('/product/create', [ProductController::class, 'create_product'])->name('create_product');
	Route::get('/product/show', [ProductController::class, 'show_product'])->name('show_product');
	Route::post('/product/store', [ProductController::class, 'store_product'])->name('store_product');
	Route::get('/product/{product}/edit', [ProductController::class, 'edit_product'])->name('edit_product');
    Route::patch('product/{id}/update', [ProductController::class, 'update'])->name('update_product');
	Route::delete('/product/{product}', [ProductController::class, 'delete_product'])->name('delete_product');
	Route::post('order/{order}/confirm', [OrderController::class, 'confirm_payment'])->name('confirm_payment');

	Route::get('/contact', [ContactController::class, 'index_contact'])->name('index_contact');
	Route::post('/contact', [ContactController::class, 'store_contact'])->name('store_contact');

});

Route::middleware(['auth'])->group(function() {
	Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');
	Route::get('/product/{product}', [ProductController::class, 'show_product'])->name('show_product');
	Route::post('/cart/add/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
	Route::get('/cart', [CartController::class, 'show_cart'])->name('show_cart');
	Route::get('/cart', [CartController::class, 'index'])->name('index_cart');
    Route::get('/cart', [CartController::class, 'index'])->name('show_cart');

    Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('update_cart');
    Route::delete('/cart/delete/{cart}', [CartController::class, 'delete'])->name('delete_cart');
    //Route::get('/cart/{id}', [CartController::class, 'show'])->name('show_cart');
	
	Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
	Route::get('/order', [OrderController::class, 'index_order'])->name('index_order');
	Route::post('/order', [OrderController::class, 'store_order'])->name('store_order');
	Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('show_order');
	Route::post('order/{order}/pay', [OrderController::class, 'submit_payment_receipt'])->name('submit_payment_receipt');

	Route::get('/profile', [ProfileController::class, 'show_profile'])->name('show_profile');
	Route::post('/profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');
	Route::put('/profile/update', [ProfileController::class, 'update_profile'])->name('update_profile');


    // routes/web.php

    Route::post('/remove-voucher', [VoucherController::class, 'remove'])->name('remove.voucher');
    Route::post('/apply-voucher', [VoucherController::class, 'apply'])->name('apply.voucher');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/voucher', [VoucherController::class, 'index_voucher'])->name('admin_index_voucher');
    Route::get('/vouchers/create', [VoucherController::class, 'create'])->name('admin_vouchers_create');
    Route::post('/vouchers', [VoucherController::class, 'store'])->name('admin_vouchers_store');
    Route::get('/voucher/{voucher}', [VoucherController::class, 'show'])->name('admin_show_voucher');
    Route::get('/voucher/{voucher}/edit', [VoucherController::class, 'edit'])->name('admin_edit_voucher');
    Route::put('/voucher/{voucher}', [VoucherController::class, 'update'])->name('admin_update_voucher');
	Route::delete('/voucher/{voucher}', [VoucherController::class, 'delete'])->name('admin_delete_voucher');

	// Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Products
    Route::resource('/product',ProductController::class)->names('admin_product');
    
    // Vouchers
    Route::resource('/voucher', VoucherController::class)->names('admin_vouchers_create');
    
    // Orders
    Route::resource('/order', OrderController::class)->except(['create', 'store'])->names('admin.orders');
    
    // Users
    Route::resource('/user', UserController::class)->except(['create', 'store'])->names('admin.users');
});

Route::prefix('admin')->group(function () {
    Route::resource('products', 'Admin\AdminProductController');
    Route::resource('vouchers', 'Admin\VoucherController');
    Route::resource('orders', 'Admin\AdminOrderController');
    Route::resource('users', 'Admin\UserController');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout_index');
    Route::post('/checkout/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name ('checkout_apply_voucher');
    Route::post('/checkout/remove-voucher', [CheckoutController::class, 'removeVoucher'])->name('checkout_remove_voucher');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout_process');
	Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout_store');
	
});


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
