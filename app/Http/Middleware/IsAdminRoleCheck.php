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
    

        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with([
                'success' => false,
                'status' => 'error',
                'message' => 'Admin authentication failed',
            ], 403);
        }
       
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'Admin')
        {
            return $next($request);
        }
        elseif(Auth::guard('admin')->user() && Auth::guard('admin')->user()->role == 'Super Admin')
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('admin.login')->with([
                'success' => false,
                'status' => 'error',
                'message' => 'Admin authentication failed',
            ], 403);
        }
    }
}
