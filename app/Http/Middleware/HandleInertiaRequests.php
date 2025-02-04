<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HandleInertiaRequests extends Middleware
{
    
    //protected $rootView = 'app';

    public function rootView(Request $request): string
   {
        Log::info('Interia Route is ',[$request->routeIs('admin*')]);
        if ($request->routeIs('admin*')) { // Example: If route starts with admin.
            return 'admin/adminlayout'; //use admin.blade.php
        } elseif($request->routeIs('*fronthome*')) { // Example: If route starts with user.
            return 'reactlayout'; //use user.blade.php
        }
        else {
            return 'app'; // Default layout (app.blade.php)
        }
    }
     
    
    public function version(Request $request): ?string
    {
        \Log::info('Interia Middleware Calling',[$request]);
        return parent::version($request);
    }


    public function share(Request $request): array
    {
        \Log::info('Interia Middleware Calling',[$request]);
       /* return array_merge(parent::share($request), [
            'auth' => [
                'user' => Auth::check() ? Auth::user() : null,
            ],
        ]);*/

$username = Session::get('username', Auth::check() ? Auth::user()->name : 'Guest');

    \Log::info('Inertia Middleware - Username:', ['username' => $username]);

    return array_merge(parent::share($request), [
        'username' => $username,
        'userid' => Session::get('userid', Auth::check() ? Auth::user()->id : null),
        'pagetitle' => "Venue",
        'pageroot' => "Home",
        'auth' => Auth::check() ? Auth::user()->id : null
    ]);







    }
}
