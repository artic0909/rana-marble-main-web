<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ── Index — list all orders ───────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'items'])->latest();

        // Filter by status tab
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Search by order number or customer name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', fn($c) => $c->where('name', 'like', "%{$search}%"));
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        // Status counts for the summary tabs
        $counts = [
            'all'        => Order::count(),
            'pending'    => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped'    => Order::where('status', 'shipped')->count(),
            'delivered'  => Order::where('status', 'delivered')->count(),
            'cancelled'  => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.orders.orders', compact('orders', 'counts'));
    }

    // ── Show — single order detail ────────────────────────────────────────────
    public function show(Order $order)
    {
        $order->load(['customer', 'items.product', 'items.variant']);
        return view('admin.orders.show', compact('order'));
    }

    // ── Update Status ─────────────────────────────────────────────────────────
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,delivered,cancelled'],
        ]);

        $order->update(['status' => $request->status]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated to ' . ucfirst($request->status),
                'status'  => $order->status,
            ]);
        }

        return back()->with('success', 'Order status updated to ' . ucfirst($request->status) . '.');
    }
}