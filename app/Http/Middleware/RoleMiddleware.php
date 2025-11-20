<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/auth/login'); // Agar login bo‘lmagan bo‘lsa
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Sizda bu sahifaga kirish huquqi yo‘q!');
        }

        return $next($request);
    }
}
