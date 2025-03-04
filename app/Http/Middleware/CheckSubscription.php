<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
Use App\Models\Subscriber;
Use App\Models\User;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $planType) {
        $user = Auth::user();
        $subscriber = Subscriber::where('user_id',$user->id)->where('status', 'Active')->first();

        if (!$subscriber || $subscriber->subscriptionPlan->name !== $planType) {
            return abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
