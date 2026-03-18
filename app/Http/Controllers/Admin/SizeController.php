<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::orderBy('id', 'desc')->get();
        
        return view('admin.size.size' , compact('sizes'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name',
        ]);

        try {
            Size::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
            ]);

            return redirect()->back()->with('success', 'Size added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name,' . $id,
        ]);

        try {
            Size::where('id', $id)->update([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
            ]);

            return redirect()->back()->with('success', 'Size updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function delete(Request $request, $id)
    {
        try {
            Size::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Size deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
