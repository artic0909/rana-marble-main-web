<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('orders')->latest()->paginate(20);

        $totalCustomer = Customer::count();
        $currentMonthTotalCustomer = Customer::whereMonth('created_at', date('m'))->count();

        return view('admin.customers.index', compact('customers', 'totalCustomer', 'currentMonthTotalCustomer'));
    }

    public function show()
    {
        return view('admin.customers.show');
    }
}
