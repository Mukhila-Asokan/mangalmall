<?php

namespace Modules\VenueAdmin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class VenueAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {

        if (!$request->session()->has('mobile_verified')) {  

            return redirect()->route('venue/login'); 
        }
       
       return $next($request);
    }
}
