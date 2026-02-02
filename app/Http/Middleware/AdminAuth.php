<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    // Proteksi route admin
    public function handle(Request $request, Closure $next)
    {
        // TODO: Implement admin authentication check
        return $next($request);
    }
}
