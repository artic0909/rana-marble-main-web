<?php

use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ContactController;
use App\Http\Controllers\Customer\IndexController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::get('/about', [CustomerController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Reviews ==========================================================================
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');




// Auth ==========================================================================
Route::get('/login', [CustomerAuthController::class, 'login'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'loginPost'])->name('login.post');

Route::get('/register', [CustomerAuthController::class, 'register'])->name('register');
Route::post('/register', [CustomerAuthController::class, 'registerPost'])->name('register.post');

Route::get('/forgetpassword', [CustomerAuthController::class, 'forgetpassword'])->name('forgetpassword');
Route::post('/forgetpassword/send-otp', [CustomerAuthController::class, 'sendOtp'])->name('forgetpassword.send-otp');
Route::post('/forgetpassword/verify-otp', [CustomerAuthController::class, 'verifyOtp'])->name('forgetpassword.verify-otp');
Route::post('/forgetpassword/reset', [CustomerAuthController::class, 'forgetpasswordPost'])->name('forgetpassword.reset');



Route::middleware(['auth:customer'])->prefix('customer')->name('customer.')->group(function () {

    Route::get('/rana-marble', [IndexController::class, 'index'])->name('home');



    // Cart ==========================================================================
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Profile ==========================================================================
    Route::get('/profile', [CustomerAuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [CustomerAuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/password/update', [CustomerAuthController::class, 'updatePassword'])->name('password.update');
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

    // Orders ==========================================================================
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

    // Wishlist ==========================================================================
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/{id}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::delete('/wishlist', [WishlistController::class, 'clearWishlist'])->name('wishlist.clear');


    // Normals ==========================================================================
    Route::get('/about', [CustomerController::class, 'about'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Products ==========================================================================
    Route::get('/products', [ProductController::class, 'allProducts'])->name('product.all');
    Route::get('/products/{slug}', [ProductController::class, 'categoryWiseAllProducts'])->name('product.all.category');
    Route::get('/{slug}', [ProductController::class, 'productDetails'])->name('product.detail');
});

// Products ==========================================================================
Route::get('/products', [ProductController::class, 'allProducts'])->name('product.all');
Route::get('/products/{slug}', [ProductController::class, 'categoryWiseAllProducts'])->name('product.all.category');
Route::get('/{slug}', [ProductController::class, 'productDetails'])->name('product.detail');
