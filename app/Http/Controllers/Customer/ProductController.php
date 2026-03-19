<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Color;
use App\Models\Pincode;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function allProducts()
    {
        $heroBanners = Banner::where('placement', 'all_products')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $categories = Category::orderBy('name')->get();
        $colors = Color::get();

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

        // Get global price bounds across ALL active products (not paginated)
        $priceStats = DB::table('product_variants')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->where('products.status', 'active')
            ->selectRaw('MIN(product_variants.price) as min_price, MAX(product_variants.price) as max_price')
            ->first();

        $priceMin = (int) floor($priceStats->min_price ?? 0);
        $priceMax = (int) ceil($priceStats->max_price ?? 500000);

        $products = Product::with(['category', 'variants.color', 'variants.size'])
            ->where('status', 'active')
            ->latest()
            ->paginate(12);


        return view('products', compact('categories', 'heroBanners', 'seo', 'products', 'priceMin', 'priceMax', 'colors'));
    }


    public function categoryWiseAllProducts($slug)
    {
        $heroBanners = Banner::where('placement', 'all_products')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $categories = Category::orderBy('name')->get();
        $colors = Color::get();

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

        // Get global price bounds across ALL active products (not paginated)
        $priceStats = DB::table('product_variants')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->where('products.status', 'active')
            ->selectRaw('MIN(product_variants.price) as min_price, MAX(product_variants.price) as max_price')
            ->first();

        $priceMin = (int) floor($priceStats->min_price ?? 0);
        $priceMax = (int) ceil($priceStats->max_price ?? 500000);

        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['category', 'variants.color', 'variants.size'])
            ->where('category_id', $category->id)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        return view('products', compact('categories', 'heroBanners', 'seo', 'products', 'priceMin', 'priceMax', 'colors'));
    }

    public function productDetails($slug)
    {
        $categories = Category::orderBy('name')->get();

        $pincodes = Pincode::all();

        $categoryWiseAllProducts = Product::with(['category', 'variants.color', 'variants.size'])
            ->where('status', 'active')
            ->latest()
            ->get();

        $product = Product::with([
            'category',
            'images',
            'variants.size',
            'variants.color',
        ])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $related = Product::with(['variants'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'related', 'categories', 'pincodes', 'categoryWiseAllProducts'));
    }
}
