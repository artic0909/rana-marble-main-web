<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($slug)
    {

        $categories = Category::orderBy('name')->get();

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

        return view('product-detail', compact('product', 'related', 'categories'));
    }
}
