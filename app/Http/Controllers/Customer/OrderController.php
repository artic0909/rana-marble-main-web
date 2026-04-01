<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pincode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Orderplacedmai;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $customer   = Auth::guard('customer')->user();

        $orders = Order::with('items')
            ->where('customer_id', $customer->id)
            ->latest()
            ->get();

        return view('orders', compact('orders', 'categories'));
    }

    public function checkout(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Validate customer has pincode
        if (!$customer->pincode) {
            return back()->with('error', 'Please add your pincode in your profile before checkout.');
        }

        // Match pincode
        $matchedPincode = Pincode::where('name', $customer->pincode)->first();
        if (!$matchedPincode) {
            return back()->with('error', 'Your pincode is not in our delivery area.');
        }

        $cartItems = Cart::with([
            'product',
            'variant',
            'variant.size',
            'variant.color'
        ])->where('customer_id', $customer->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $subtotal     = $cartItems->sum(fn($i) => $i->variant->price * $i->quantity);
            $shippingFees = $matchedPincode->fees;
            $total        = $subtotal + $shippingFees;

            // Generate order number
            $orderNumber = 'RM-' . date('Y') . '-' . str_pad(
                Order::count() + 1,
                5,
                '0',
                STR_PAD_LEFT
            );

            // Create order
            $order = Order::create([
                'customer_id'      => $customer->id,
                'order_number'     => $orderNumber,
                'status'           => 'pending',
                'subtotal'         => $subtotal,
                'shipping_fees'    => $shippingFees,
                'total'            => $total,
                'pincode'          => $customer->pincode,
                'shipping_address' => $customer->address,
                'shipping_city'    => $customer->city,
                'shipping_state'   => $customer->state,
                'shipping_landmark' => $customer->landmark,
                'phone'            => $customer->phone,
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'variant_id'   => $item->variant_id,
                    'product_name' => $item->product->name,
                    'size'         => $item->variant->size?->name,
                    'color'        => $item->variant->color?->name,
                    'price'        => $item->variant->price,
                    'quantity'     => $item->quantity,
                    'subtotal'     => $item->variant->price * $item->quantity,
                ]);
            }

            // Clear cart
            Cart::where('customer_id', $customer->id)->delete();

            DB::commit();

            // Send Emails (Load items and customer for the mail view)
            $order->load(['items', 'customer']);
            
            // Mail to Customer
            Mail::to($customer->email)->send(new Orderplacedmai($order));
            
            // Mail to Admin
            Mail::to('ruidas82ramesh@gmail.com')->send(new Orderplacedmai($order, true));

            return redirect()->route('customer.orders')
                ->with('success', "Order {$orderNumber} placed successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function invoice($id)
    {
        $order = Order::with('items.product')
            ->where('customer_id', Auth::guard('customer')->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('invoice.invoice', compact('order'));
    }
}
