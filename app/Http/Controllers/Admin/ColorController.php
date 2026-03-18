<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::latest()->get();
        return view('admin.color.color', compact('colors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:colors,name',
            'hex'  => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        try {
            Color::create($validated);
            return redirect()->back()->with('success', 'Color added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:colors,name,' . $id,
            'hex'  => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        try {
            Color::where('id', $id)->update($validated);
            return redirect()->back()->with('success', 'Color updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Color::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Color deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
