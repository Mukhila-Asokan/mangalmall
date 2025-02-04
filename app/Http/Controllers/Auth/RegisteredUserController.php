<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\OtpMail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request)
    {
       

         $validator = Validator::make($request->all(), [
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);


        if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
                    }
        $otp = rand(100000, 999999);  // Generate a 6-character OTP
        \Log::info("Generated OTP: $otp");

       
        if (User::where('email', $request->email)->exists()) {
    return back()->withErrors(['email' => 'This email address is already registered.']);
}

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'otp' => $otp,
        'otp_expires_at' => Carbon::now()->addMinutes(10),
    ]);

    // Send OTP via email
    //Mail::to($user->email)->send(new OtpMail($otp));

    return redirect()->route('otp.verify')->with('success', 'An OTP has been sent to your email address.');
    }
}
