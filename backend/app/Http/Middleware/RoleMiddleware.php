<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Define role mapping
        $roles = [
            'admin' => 1,
            'manager' => 2,
        ];

        // Check if user role_id matches required role
        if (isset($roles[$role]) && $user->role_id !== $roles[$role]) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}


