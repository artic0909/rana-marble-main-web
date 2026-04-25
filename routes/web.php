<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);

require __DIR__.'/settings.php';
require __DIR__.'/admin-routes.php';
require __DIR__.'/customer-routes.php';
