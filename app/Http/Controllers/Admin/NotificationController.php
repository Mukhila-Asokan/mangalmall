<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
Use Auth;
use App\Notifications\ChangeMobileNo;
use Illuminate\Support\Facades\Session;
Use Modules\VenueAdmin\Models\VenueUser;

class NotificationController extends Controller
{
    public function index(Request $request)
{
    // Debugging check
    if (!auth('admin')->check()) {
        return response()->json([
            'success' => false,
            'status' => 'error',
            'message' => 'Admin is not authenticated. Please log in.',
        ], 403);
    }

    // Admin is authenticated, continue
    $admin = auth('admin')->user();

    // Check if admin instance is valid
    if (!$admin) {
        return response()->json([
            'success' => false,
            'status' => 'error',
            'message' => 'Authenticated admin is null.',
        ], 403);
    }

    // Fetch notifications
    $notifications = $admin->unreadNotifications;

    $username = Session::get('username');
    $userid = Session::get('userid');       
    $pagetitle = "Venue User Mobile No change Request";
    $pageroot = "Venue";  
    $id = 2;      

    return view('venue::mobilechangerequest', compact(
        'pagetitle', 
        'pageroot',     
        'username',        
        'id', 
        'notifications'
    ));
}


    public function markAsRead($id)
    {
        $admin = auth('admin')->user();
        // Check if admin instance is valid
    if (!$admin) {
        return response()->json([
            'success' => false,
            'status' => 'error',
            'message' => 'Authenticated admin is null.',
        ], 403);
    }
    
        $notification = $admin->notifications->find($id);
     

        if ($notification) {
            $notification->markAsRead();
        }

        if($notification->type == 'App\Notifications\ChangeMobileNo'){
            return redirect()->route('venue.mobilechangerequest')->with('success', 'Notification marked as read.');
        }
        else{
            return redirect()->back()->with('success', 'Notification marked as read.');
        }
    }

    
    // Admin Approves the Request
    public function approveRequest(Request $request, $userid)
    {
       
        $user = VenueUser::findOrFail($userid);

        $user->update([
            'mobileno' => $request->new_mobile
        ]);

       
        $statusMessage = "Your confirmation is approved, please check.";
        $user->notify(new ChangeMobileNo($request->new_mobile, $statusMessage));

        return redirect()->back()->with('success', 'Mobile number updated and user notified.');
    }

    public function unreadNotification(Request $request, $userid)
    {
       
        $user = VenueUser::findOrFail($userid);
       
        $user->update([
            'mobileno' => $request->new_mobile
        ]);

         /* Send Confirmation Notification to Venue User */    

        $statusMessage = "Your confirmation is approved, please check.";
        $user->notify(new ChangeMobileNo($request->new_mobile, $statusMessage));



        return redirect()->back()->with('success', 'Mobile number updated and user notified.');
    }
}
