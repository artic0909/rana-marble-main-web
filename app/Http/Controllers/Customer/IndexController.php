<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;

class IndexController extends Controller
{
    public function index()
    {
        // Banners
        $heroBanners = Banner::where('placement', 'homepage_hero')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $secondaryBanners = Banner::where('placement', 'homepage_secondary')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        // Categories
        $categories = Category::orderBy('name')->get();

        // Products
        $featuredProducts = Product::with(['category', 'variants.color', 'variants.size'])
            ->where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        // SEO
        $seo = Setting::getMany([
            'store_name',
            'store_email',
            'store_phone',
            'store_address',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'og_image',
        ]);

        return view('index', compact(
            'heroBanners',
            'secondaryBanners',
            'categories',
            'featuredProducts',
            'seo',
        ));
    }
}
