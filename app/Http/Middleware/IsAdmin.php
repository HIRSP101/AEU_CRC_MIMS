<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if(!Auth::check()) {
            return redirect('/');
        }
        // Check if the user is authenticated and has the admin role
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request); // Continue to the register route
        }

        // If not an admin, redirect to login
        return redirect('/login');
    }
}
