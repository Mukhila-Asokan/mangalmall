<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\AdminUser;
use Carbon\Carbon; 
use App\NotificationFilterTrait;

class DashboardController extends Controller
{
    use AuthorizesRequests; 
    use NotificationFilterTrait;
    public function index()
    {  
         $username = Session::get('username');
         $userid = Session::get('userid');
         $user = auth()->guard('admin')->user();
         $notifications = $user->unreadNotifications;
 
         $filteredNotifications = $this->filterNotificationsByDate($notifications); 
       
        $todayNotifications = $filteredNotifications['today'];
        $yesterdayNotifications  = $filteredNotifications['yesterday'];
        $olderNotifications  = $filteredNotifications['older'];
     
         $pagetitle = "Dashboard";
         $pageroot = "Home";
         return view('admin.dashboard', compact('pagetitle','pageroot','username','todayNotifications','yesterdayNotifications','olderNotifications'));
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

        $validator =  Validator::make($request->all(), [
        'oldpassword' => 'required',
        'newpassword' => 'required|min:8',
        'confirmpassword' => 'required|min:8']);

         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         $username = Session::get('username');
         $userid = Session::get('userid');

        

         $user = AdminUser::find($userid);

       

         if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->withErrors(['oldpassword' => __('The provided current password is incorrect.')]);
        }

        $user->forceFill([
            'password' => Hash::make($request->newpassword),
        ])->save();

         
        Auth::logout();

        return redirect()->route('admin.login')->with('success', __('Your password has been updated successfully.'));
       
    }
   public function notifications()
    {
        $user = auth()->guard('admin')->user();
        $notifications = $user->unreadNotifications;

        $filteredNotifications = $this->filterNotificationsByDate($notifications);

        $html = view('admin.layouts.notification-list', [
        'todayNotifications' => $filteredNotifications['today'],
        'yesterdayNotifications' => $filteredNotifications['yesterday'],
        'olderNotifications' => $filteredNotifications['older'],
    ])->render();

    return response()->json([
        'count' => $user->unreadNotifications->count(),
        'html' => $html
    ]);
}
public function getNotifications()
    {
        $user = auth()->guard('admin')->user();
        $notifications = $user->unreadNotifications;

        $filteredNotifications = $this->filterNotificationsByDate($notifications);

        return view('admin.notifications', [
            'todayNotifications' => $filteredNotifications['today'],
            'yesterdayNotifications' => $filteredNotifications['yesterday'],
            'olderNotifications' => $filteredNotifications['older'],
        ]);
    }

}
