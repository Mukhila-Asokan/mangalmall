<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdminRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure the user is authenticated as an admin
        $admin = Auth::guard('admin')->user();

      

        if (!$admin) {
            return redirect()->route('admin.login')->with([
                'success' => false,
                'status' => 'error',
                'message' => 'Admin authentication failed. Please log in.',
            ]);
        }

        // Role-based authorization
        if ($admin->role === 'Admin' || $admin->role === 'Super Admin') {
            return $next($request);
        }

        // If the user does not have an appropriate role
        return redirect()->route('admin.login')->with([
            'success' => false,
            'status' => 'error',
            'message' => 'Access denied. Insufficient permissions.',
        ]);
    }
}
