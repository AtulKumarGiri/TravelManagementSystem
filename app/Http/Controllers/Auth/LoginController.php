<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login for Admin / Partner / Supplier / Customer
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|in:admin,partner,supplier,customer',
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        // --- ADMIN LOGIN ---
        if ($role === 'admin') {
            if (Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard')->with('success', 'Welcome Admin!');
            }
        }

        // --- OTHER USERS (Partner/Supplier/Customer) ---
        if (in_array($role, ['partner', 'supplier', 'customer'])) {
            if (Auth::guard('web')->attempt(array_merge($credentials, ['role' => $role]))) {
                $request->session()->regenerate();

                switch ($role) {
                    case 'partner':
                        return redirect()->intended('/partner/dashboard')->with('success', 'Welcome Partner!');
                    case 'supplier':
                        return redirect()->intended('/supplier/dashboard')->with('success', 'Welcome Supplier!');
                    case 'customer':
                        return redirect()->intended('/customer/dashboard')->with('success', 'Welcome Customer!');
                }
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or role. Please try again.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Logged out successfully.');
    }
}
