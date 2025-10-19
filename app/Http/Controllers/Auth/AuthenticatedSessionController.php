<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // ----------------------------
    // ADMIN LOGIN
    // ----------------------------
    public function showAdminLoginForm()
    {
        return view('auth.login', [
            'role' => 'admin',
            'colors' => [
                'start' => '#141E30',
                'end' => '#243B55',
                'button_start' => '#243B55',
                'button_end' => '#141E30',
            ],
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,partner,supplier,customer',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $role = $request->input('role');

        if (Auth::guard($role)->attempt($credentials)) {
            $request->session()->regenerate();

            return match($role) {
                'admin' => redirect()->route('layout.admin'),
                'partner' => redirect()->route('layout.partner'),
                'supplier' => redirect()->route('layout.supplier'),
                'customer' => redirect()->route('layout.customer'),
            };
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with('status', 'Logged out successfully.');
    }

    // ----------------------------
    // PARTNER / SUPPLIER / CUSTOMER LOGIN
    // ----------------------------
    public function showLoginForm($role)
{
    // Make role lowercase to match correctly
    $role = strtolower($role);

    // Define colors for roles
    $colors = [
        'partner'  => ['start'=>'#00c6ff','end'=>'#0072ff','button_start'=>'#0072ff','button_end'=>'#00c6ff'],
        'supplier' => ['start'=>'#f7971e','end'=>'#ffd200','button_start'=>'#ffd200','button_end'=>'#f7971e'],
        'customer' => ['start'=>'#00b09b','end'=>'#96c93d','button_start'=>'#96c93d','button_end'=>'#00b09b'],
        'admin'    => ['start'=>'#141E30','end'=>'#243B55','button_start'=>'#243B55','button_end'=>'#141E30'],
    ];

    // Ensure $colors is always an array
    $roleColors = $colors[$role] ?? ['start'=>'#ccc','end'=>'#999','button_start'=>'#999','button_end'=>'#ccc'];

    return view('auth.login', [
        'role' => $role,
        'colors' => $roleColors,
    ]);
}



    public function userLogin(Request $request, $role)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $role
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended("/{$role}/dashboard");
        }

        return back()->withErrors(['email' => "Invalid $role credentials."]);
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'Logged out successfully.');
    }
}
