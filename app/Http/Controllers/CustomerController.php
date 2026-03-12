<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function allProducts()
    {

        return view('products');
    }

    public function about()
    {
        return view('about');
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
