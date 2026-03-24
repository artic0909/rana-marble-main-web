<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $categories    = Category::orderBy('name')->get();
        $wishlistItems = Wishlist::with(['product', 'product.category', 'product.variants'])
            ->where('customer_id', Auth::guard('customer')->id())
            ->latest()
            ->get();

        return view('wishlist', compact('wishlistItems', 'categories'));
    }

    public function addToWishlist(Request $request, $id)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json([
                'success'  => false,
                'redirect' => route('login'),
                'message'  => 'Please login to add items to wishlist.',
            ]);
        }

        $customerId = Auth::guard('customer')->id();

        // Toggle — if exists remove, else add
        $existing = Wishlist::where('customer_id', $customerId)
            ->where('product_id', $id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json([
                'success' => true,
                'added'   => false,
                'message' => 'Removed from wishlist.',
            ]);
        }

        Wishlist::create([
            'customer_id' => $customerId,
            'product_id'  => $id,
        ]);

        return response()->json([
            'success' => true,
            'added'   => true,
            'message' => 'Added to wishlist!',
        ]);
    }

    public function removeFromWishlist(Request $request, $id)
    {
        Wishlist::where('customer_id', Auth::guard('customer')->id())
            ->where('id', $id)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function clearWishlist()
    {
        Wishlist::where('customer_id', Auth::guard('customer')->id())->delete();
        return response()->json(['success' => true]);
    }
}