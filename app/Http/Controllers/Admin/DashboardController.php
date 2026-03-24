<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::sum('total');
        $totalOrders = Order::count();
        $totalCustomer = Customer::count();
        return view('admin.dashboard.dashboard', compact('totalRevenue', 'totalOrders', 'totalCustomer'));
    }
}
