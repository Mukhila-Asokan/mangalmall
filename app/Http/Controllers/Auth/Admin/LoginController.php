<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\AdminUser;

class LoginController extends Controller
{

   use AuthorizesRequests; 

    public function __construct()
    {
        
    }


   /* public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('log', only: ['index']),
            new Middleware('subscribed', except: ['store']),
        ];
    }*/


    public function create(): View
    {
        return view('admin/auth/login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function authcheck(Request $request)
    {

       $request->validate([
           'email' => 'required|email',
            'password' => 'required'
        ]);

         $credentials = $request->only('email', 'password');

         \Log::info('Admin credentials:', [$credentials]);

        if (Auth::guard('admin')->attempt($credentials)) {
           
          

          $session = $request->session()->regenerate();

           \Log::info('Admin session:', [$session]);
           
            return redirect(route('adminrole'));
     
        }else{
            return redirect(route('admin.login'))->with([
                'error' => "Invalid Credentials."
            ]);
        }


    }

}
