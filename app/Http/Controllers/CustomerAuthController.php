<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function login()
    {
        $categories = Category::orderBy('name')->get();
        return view('login', compact('categories'));
    }

    public function register()
    {
        $categories = Category::orderBy('name')->get();
        return view('register', compact('categories'));
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('customer.home');
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'email'            => 'required|email|unique:customers,email',  // ← customers table
            'phone'            => 'nullable|string|max:20',
            'password'         => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        Customer::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Account created successfully! Please sign in.');
    }

    public function profile()
    {
        $categories = Category::orderBy('name')->get();
        return view('profile', compact('categories'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:500',
            'landmark' => 'nullable|string|max:255',
            'pincode'  => 'nullable|string|max:10',
            'city'     => 'nullable|string|max:100',
            'state'    => 'nullable|string|max:100',
        ]);

        Auth::guard('customer')->user()->update($request->only(
            'name',
            'phone',
            'address',
            'landmark',
            'pincode',
            'city',
            'state'
        ));

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required|string',
            'new_password'          => 'required|string|min:8|confirmed',
        ]);

        $customer = Auth::guard('customer')->user();

        // Check current password matches
        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->with('password_error', 'Current password is incorrect.');
        }

        // Check new password is not same as old
        if (Hash::check($request->new_password, $customer->password)) {
            return back()->with('password_error', 'New password cannot be the same as current password.');
        }

        $customer->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('password_success', 'Password updated successfully!');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function forgetpassword()
    {
        $categories = Category::orderBy('name')->get();
        return view('forgetpassword', compact('categories'));
    }
}
