<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        return view('admin.return.return');
    }

    public function show()
    {
        return view('admin.return.show');
    }
}
