<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    // Proteksi route admin
    public function handle(Request $request, Closure $next)
    {
        if (! \Illuminate\Support\Facades\Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
