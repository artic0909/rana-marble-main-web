<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Redirect to login if not authenticated
        if (!Auth::guard('customer')->check()) {
            return response()->json([
                'success'  => false,
                'redirect' => route('login'),
                'message'  => 'Please login to add items to cart.',
            ]);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity'   => 'integer|min:1|max:10',
        ]);

        $customerId = Auth::guard('customer')->id();

        // If already in cart, increment quantity
        $cart = Cart::where('customer_id', $customerId)
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($cart) {
            $cart->increment('quantity', $request->quantity ?? 1);
        } else {
            Cart::create([
                'customer_id' => $customerId,
                'product_id'  => $request->product_id,
                'variant_id'  => $request->variant_id,
                'quantity'    => $request->quantity ?? 1,
            ]);
        }

        $cartCount = Cart::where('customer_id', $customerId)->sum('quantity');

        return response()->json([
            'success'    => true,
            'message'    => 'Item added to cart!',
            'cart_count' => $cartCount,
        ]);
    }

    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $customerId = Auth::guard('customer')->id();
        $customer   = Auth::guard('customer')->user();

        $cartItems = Cart::with([
            'product',
            'product.category',
            'variant',
            'variant.size',
            'variant.color',
        ])->where('customer_id', $customerId)->get();

        $total = $cartItems->sum(fn($item) => ($item->variant->price ?? 0) * $item->quantity);

        // Match customer pincode with pincodes table
        $matchedPincode = null;
        if ($customer->pincode) {
            $matchedPincode = \App\Models\Pincode::where('name', $customer->pincode)->first();
        }

        return view('cart', compact(
            'cartItems',
            'total',
            'categories',
            'customer',
            'matchedPincode'
        ));
    }

    public function remove(Request $request, $id)
    {
        Cart::where('id', $id)
            ->where('customer_id', Auth::guard('customer')->id())
            ->delete();

        return response()->json(['success' => true]);
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:10']);

        Cart::where('id', $id)
            ->where('customer_id', Auth::guard('customer')->id())
            ->update(['quantity' => $request->quantity]);

        return response()->json(['success' => true]);
    }
}
