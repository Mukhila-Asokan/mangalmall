<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
//use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
Use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        $request->session()->regenerate();     
        $credentials = $request->only('email', 'password');   
        $user = Auth::user();  

      
       /* try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }*/

        $cookie = new Cookie('jwt', json_encode($credentials)); 
        
        /*$cookie = cookie('jwt',$credentials,60*2);*/
        return redirect()->intended(route('dashboard', absolute: false))->withCookie($cookie);
    }

    public function logincheck(Request $request)
    {
         
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email address is required!',
            'password.required' => 'Password is required!',
        ]);
    
        if (Auth::attempt($validated)) {
            $user = Auth::user();
    
            // Check if email is verified
            if (empty($user->email_verified_at)) {
                $otp = rand(100000, 999999);  
                \Log::info("Generated OTP: $otp");
                $otptime = now()->addMinutes(10);
                $user->update([
                    'otp' => $otp,
                    'otp_expires_at' => $otptime,  
                ]);
    
                return redirect()->route('otp.verify')->with('success', 'An OTP has been sent to your email.');
            } else {


              
                $token = JWTAuth::fromUser($user);
                $cookie = cookie('jwt', $token, 60 * 24);
    
                return redirect()->intended(route('dashboard'))->withCookie($cookie);
            }
        }
    
        return redirect('/')->with('error', 'Authentication failed. Please check your credentials.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {   
       
        
        $user = Auth::user();  
       
 
        if ($user) {
           
            $token = $user->createToken('MangalMall')->plainTextToken;

           
            $cookie = cookie('jwt', $token, 60); 
        }

        
        Auth::guard('web')->logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        //event(new Logout('web', $user));

       
       $cookie = Cookie::make('jwt', '', -1); 
        
        return redirect('/')->withCookie($cookie);
        }
}
