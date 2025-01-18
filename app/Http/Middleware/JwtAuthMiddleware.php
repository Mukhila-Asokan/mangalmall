<?php

namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class JwtAuthMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            
            $headers = apache_request_headers(); //get header
            $request->headers->set('Authorization', $headers['authorization']);// set header in request
            $token = JWTAuth::getTokenFromRequest(); 
            $user = JWTAuth::parseToken($token)->authenticate();

            if($user)
            {
                 return $next($request);
            }
            else
            {
                return redirect(route('home/login'));
            }


        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'], 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired'], 401);
            }else{
                return response()->json(['status' => 'Authorization Token not found'], 401);
            }
        }

       
    }
}
