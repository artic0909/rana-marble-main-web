<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'placement' => 'required|in:' . implode(',', array_keys(Banner::PLACEMENTS)),
            'image'     => 'required|image|max:5120',
            'status'    => 'required|in:active,draft,inactive',
        ]);

        try {
            $path = $request->file('image')->store('banners', 'public');

            Banner::create([
                'title'      => $request->title,
                'placement'  => $request->placement,
                'image'      => $path,
                'status'     => $request->status,
                'sort_order' => Banner::max('sort_order') + 1,
            ]);

            return redirect()->back()->with('success', 'Banner created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title'     => 'required|string|max:255',
            'placement' => 'required|in:' . implode(',', array_keys(Banner::PLACEMENTS)),
            'image'     => 'nullable|image|max:5120',
            'status'    => 'required|in:active,draft,inactive',
        ]);

        try {
            $data = [
                'title'     => $request->title,
                'placement' => $request->placement,
                'status'    => $request->status,
            ];

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($banner->image);
                $data['image'] = $request->file('image')->store('banners', 'public');
            }

            $banner->update($data);

            return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            Storage::disk('public')->delete($banner->image);
            $banner->delete();

            return redirect()->back()->with('success', 'Banner deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
