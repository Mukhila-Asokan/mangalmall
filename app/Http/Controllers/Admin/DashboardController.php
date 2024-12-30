<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use AdminUser;

class DashboardController extends Controller
{
    public function index()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');

         $pagetitle = "Dashboard";
         $pageroot = "Home";
         return view('admin.dashboard', compact('pagetitle','pageroot','username'));
    }
    public function changepassword()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');

         $pagetitle = "Change Password";
        return view('admin.password', compact('pagetitle','username'));
    }

    public function passwordupdate(Request $request)
    {
        $pagetitle = "Change Password";


        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8|confirmed',
            'confirmpassword' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         $username = Session::get('username');
         $userid = Session::get('id');

         $user = AdminUser::find($userid);

         if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->withErrors(['oldpassword' => __('The provided current password is incorrect.')]);
        }

        $user->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

         
        Auth::logout();

        return redirect()->route('admin.login')->with('status', __('Your password has been updated successfully.'));
           
                
    }
}
