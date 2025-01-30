<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function showVerifyForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to verify OTP.');
    }

    $request->validate([
        'otp' => 'required|string|size:6',
    ]);

    $user = Auth::user(); // Now this will not return null if the user is logged in

    if ($user->otp !== $request->otp) {
        return back()->withErrors(['otp' => 'The provided OTP is incorrect.']);
    }

    if (Carbon::now()->greaterThan($user->otp_expires_at)) {
        return back()->withErrors(['otp' => 'The OTP has expired.']);
    }

    $user->update([
        'otp' => null,
        'otp_expires_at' => null,
        'email_verified_at' => now(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Your email has been verified successfully!');
    }
}
