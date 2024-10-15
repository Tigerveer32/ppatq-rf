<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.'); // Atau redirect ke login
        }
    
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Access denied.'); // Pesan error jika role tidak cocok
        }
        
        return $next($request);
    }
    
}

