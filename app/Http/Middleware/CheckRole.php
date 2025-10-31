<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Check if user role matches required role
        if ($role === 'admin' && $user->isAdmin()) {
            return $next($request);
        }

        if ($role === 'landlord' && $user->isLandlord()) {
            return $next($request);
        }

        if ($role === 'agent' && $user->isAgent()) {
            return $next($request);
        }

        if ($role === 'tenant' && $user->isTenant()) {
            return $next($request);
        }

        // Redirect to appropriate dashboard based on role
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        } elseif ($user->isLandlord()) {
            return redirect('/landlord/dashboard');
        } elseif ($user->isAgent()) {
            return redirect('/agent/dashboard');
        } elseif ($user->isTenant()) {
            return redirect('/tenant/profile');
        }

        return redirect('/home');
    }
}
