<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SupportController;
use Illuminate\Support\Facades\Route;

// Login 
Route::get('admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

    // Size
    Route::get('/sizes', [SizeController::class, 'index'])->name('sizes');
    Route::post('/sizes', [SizeController::class, 'store'])->name('sizes.store');
    Route::post('/sizes/edit/{id}', [SizeController::class, 'edit'])->name('sizes.edit');
    Route::post('/sizes/delete/{id}', [SizeController::class, 'delete'])->name('sizes.delete');

    // Color
    Route::get('/colors', [ColorController::class, 'index'])->name('colors');
    Route::post('/colors', [ColorController::class, 'store'])->name('colors.store');
    Route::post('/colors/edit/{id}', [ColorController::class, 'edit'])->name('colors.edit');
    Route::post('/colors/delete/{id}', [ColorController::class, 'delete'])->name('colors.delete');

    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/show', [ProductController::class, 'show'])->name('products.show');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/show', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
    Route::get('/returns/show', [ReturnController::class, 'show'])->name('returns.show');

    Route::get('/shippings', [ShippingController::class, 'index'])->name('shippings');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/show', [CustomerController::class, 'show'])->name('customers.show');

    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/edit', [BannerController::class, 'show'])->name('banners.edit');

    Route::get('/support', [SupportController::class, 'index'])->name('support');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
