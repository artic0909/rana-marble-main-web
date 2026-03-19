<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pincode;
use Illuminate\Http\Request;

class PincodeController extends Controller
{
    public function index()
    {
        $pincodes = Pincode::orderBy('id', 'desc')->get();

        return view('admin.pincode.pincode', compact('pincodes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pincodes,name',
            'fees'  => 'required|string',
        ]);

        try {
            Pincode::create($validated);
            return redirect()->back()->with('success', 'Pincode added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pincodes,name,' . $id,
            'fees'  => 'required|string',
        ]);

        try {
            Pincode::where('id', $id)->update($validated);
            return redirect()->back()->with('success', 'Pincode updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Pincode::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Pincode deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
