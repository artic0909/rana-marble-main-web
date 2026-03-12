<?php

use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CustomerController::class, 'index'])->name('home');
Route::get('/products', [CustomerController::class, 'allProducts'])->name('allProducts');
Route::get('/about', [CustomerController::class, 'about'])->name('about');
Route::get('/contact', [CustomerController::class, 'contact'])->name('contact');
Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
Route::get('/cart', [CustomerController::class, 'cart'])->name('cart');
Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
Route::get('/wishlist', [CustomerController::class, 'wishlist'])->name('wishlist');

Route::get('/login', [CustomerAuthController::class, 'login'])->name('login');
Route::get('/register', [CustomerAuthController::class, 'register'])->name('register');
Route::get('/forgetpassword', [CustomerAuthController::class, 'forgetpassword'])->name('forgetpassword');
