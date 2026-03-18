<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function allProducts()
    {

        return view('products');
    }

    public function about()
    {
        $categories = Category::orderBy('name')->get();
        return view('about' , compact('categories'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function profile()
    {
        return view('profile');
    }

    public function cart()
    {
        return view('cart');
    }

    public function orders()
    {
        return view('orders');
    }

    public function wishlist()
    {
        return view('wishlist');
    }
}
