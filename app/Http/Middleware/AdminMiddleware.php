<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Use 'admin' guard instead of default
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login', ['role' => 'admin']);
        }

        return $next($request);
    }
}
