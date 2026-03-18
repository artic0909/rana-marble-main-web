<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::getMany([
            'store_name',
            'store_email',
            'store_phone',
            'store_website',
            'store_address',
            'store_description',
            'store_logo',
            'maintenance_mode',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'og_image',
            'robots',
            'google_verification',
        ]);

        return view('admin.settings.index', compact('settings'));
    }

    public function updateStore(Request $request)
    {
        $request->validate([
            'store_name'        => 'required|string|max:255',
            'store_email'       => 'required|email|max:255',
            'store_phone'       => 'nullable|string|max:50',
            'store_website'     => 'nullable|url|max:255',
            'store_address'     => 'nullable|string|max:500',
            'store_description' => 'nullable|string|max:1000',
            'store_logo'        => 'nullable|image|max:2048',
            'maintenance_mode'  => 'nullable|in:0,1',
        ]);

        try {
            Setting::setMany([
                'store_name'        => $request->store_name,
                'store_email'       => $request->store_email,
                'store_phone'       => $request->store_phone,
                'store_website'     => $request->store_website,
                'store_address'     => $request->store_address,
                'store_description' => $request->store_description,
                'maintenance_mode'  => $request->has('maintenance_mode') ? '1' : '0',
            ]);

            if ($request->hasFile('store_logo')) {
                $old = Setting::get('store_logo');
                if ($old) Storage::disk('public')->delete($old);
                $path = $request->file('store_logo')->store('settings', 'public');
                Setting::set('store_logo', $path);
            }

            return redirect()->back()->with('success', 'Store settings saved');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Current password is incorrect'])
                ->with('active_tab', 'security');
        }

        try {
            $admin->update(['password' => Hash::make($request->password)]);
            return redirect()->back()->with('success', 'Password updated successfully')->with('active_tab', 'security');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('active_tab', 'security');
        }
    }

    public function updateSeo(Request $request)
    {
        $request->validate([
            'meta_title'           => 'nullable|string|max:255',
            'meta_description'     => 'nullable|string|max:500',
            'meta_keywords'        => 'nullable|string|max:500',
            'og_image'             => 'nullable|url|max:500',
            'robots'               => 'nullable|in:index_follow,no_index,no_follow',
            'google_verification'  => 'nullable|string|max:255',
        ]);

        try {
            Setting::setMany([
                'meta_title'          => $request->meta_title,
                'meta_description'    => $request->meta_description,
                'meta_keywords'       => $request->meta_keywords,
                'og_image'            => $request->og_image,
                'robots'              => $request->robots,
                'google_verification' => $request->google_verification,
            ]);

            return redirect()->back()->with('success', 'SEO settings saved')->with('active_tab', 'seo');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('active_tab', 'seo');
        }
    }
}
