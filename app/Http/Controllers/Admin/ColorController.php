<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        return view('admin.color.color');
    }
}
