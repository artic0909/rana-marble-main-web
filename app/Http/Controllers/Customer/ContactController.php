<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contactmail;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('contact', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'email'        => 'nullable|email|max:255',
            'inquiry_about'     => 'required|string',
            'message'      => 'required|string|max:2000',
        ]);

        $contact = Contact::create([
            'customer_id'   => Auth::guard('customer')->id(), // null for guests
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->phone,
            'inquiry_about' => $request->inquiry_about,
            'message'       => $request->message,
        ]);

        // Send Enquiry Email to Admin
        Mail::to('ruidas82ramesh@gmail.com')->send(new Contactmail($contact));

        return back()->with('contact_success', 'Thank you! We will respond within 24 hours.');
    }
}
