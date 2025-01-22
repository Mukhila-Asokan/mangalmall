<?php

namespace Modules\Merchandiser\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MerchandiserAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
