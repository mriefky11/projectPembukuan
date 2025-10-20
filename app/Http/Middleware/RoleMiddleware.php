<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            abort(403, 'Akses ditolak.');
        }

        $rolesArray = explode('|', $roles);
        if (!in_array(Auth::user()->role, $rolesArray)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}