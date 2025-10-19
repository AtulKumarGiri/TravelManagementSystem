<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

use App\Models\Setting;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.user.profile', compact('user'));
    }

    public function changePassword()
    {
        return view('admin.user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        if (Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'New password cannot be the same as the current password.');
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return back()->with('success', 'Password updated successfully.');
    }




    // Settings
    public function settings()
    {
        $settings = [
            'site_name' => config('app.name'),
            'admin_email' => setting('admin_email', 'admin@travel.com'),
            'contact_number' => setting('contact_number', ''),
            'address' => setting('address', ''),
            'maintenance_mode' => setting('maintenance_mode', false),
            'logo' => setting('logo', null),
        ];

        return view('admin.user.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'maintenance_mode' => 'nullable|boolean',
        ]);

        $settingsData = [
            'site_name' => $request->site_name,
            'admin_email' => $request->admin_email,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
        ];

        foreach ($settingsData as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
        }

        $secretToken = null;

        if ($request->has('maintenance_mode')) {
            $secretToken = 'admin-bypass-' . bin2hex(random_bytes(6));

            Artisan::call('down', [
                '--secret' => $secretToken
            ]);

            Setting::updateOrCreate(['key' => 'maintenance_mode'], ['value' => 1]);
            Setting::updateOrCreate(['key' => 'maintenance_bypass_token'], ['value' => $secretToken]);
        } else {
            Artisan::call('up');

            Setting::updateOrCreate(['key' => 'maintenance_mode'], ['value' => 0]);
            Setting::updateOrCreate(['key' => 'maintenance_bypass_token'], ['value' => null]);
        }

        $message = $request->has('maintenance_mode')
            ? "Settings saved. Maintenance mode is ON. Admin bypass link generated."
            : "Settings saved. Maintenance mode is OFF.";

        return back()->with('success', $message);
    }



}
