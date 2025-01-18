<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class FlashMessageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
         if (Session::has('username')) {
            $username =  Session::get('username');           
            $username = preg_replace('/\s+/', '_', $username);
            View::share('userpath',$username);
            Session::forget('username'); 
        }

         return $next($request);
    }
}
