<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->isRole() == 'Admin')
        {
            return $next($request);
        }
        elseif(Auth::user() && Auth::user()->isRole() == 'Super Admin')
        {
            return $next($request);
        }
        else
        {
            return redirect(route('admin/login'));
        }
    }
}
