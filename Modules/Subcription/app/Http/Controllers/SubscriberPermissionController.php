<?php

namespace Modules\Subcription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Modules\Subcription\Models\SubscriberPlanMenu;
Use Modules\Subcription\Models\SubscriptionPlan;
Use Modules\Subcription\Models\UserMenu;
use Illuminate\Support\Facades\Validator;
use Session;    

class SubscriberPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Subscription";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Subscriber Permissions";
        $menuPermissions = SubscriberPlanMenu::where('delete_status', '0')->paginate(10);
        return view('subcription::subscriptionmenupermission.index', compact('pagetitle', 'pageroot', 'menuPermissions', 'username'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Subscription";
        $pagetitle = "Create Subscriber Permission";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $usermenus = UserMenu::where('delete_status', '0')->get();
        $subscriberplans = SubscriptionPlan::where('delete_status', '0')->get();
        return view('subcription::subscriptionmenupermission.create', compact('pagetitle', 'pageroot','username','usermenus','subscriberplans'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscriber_id' => 'required|integer',
            'menu_id' => 'required|integer',
            'access' => 'required|string',           
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $subscriberPermission = new SubscriberPlanMenu();
            $subscriberPermission->subscriber_id = $request->subscriber_id;
            $subscriberPermission->menu_id = $request->menu_id;
            $subscriberPermission->access = $request->access;
            $subscriberPermission->status = 'Active';
            $subscriberPermission->delete_status = 0;
            $subscriberPermission->save();

            return redirect()->route('admin.subscriptionmenupermission')->with('success', 'Subscriber Permission created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the Subscriber Permission: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('subcription::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Subscription";
        $pagetitle = "Edit Subscriber Permission";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $usermenus = UserMenu::where('delete_status', '0')->get();
        $subscriberplans = SubscriptionPlan::where('delete_status', '0')->get();
        $subscriberPermission = SubscriberPlanMenu::find($id);

        if (!$subscriberPermission) {
            return redirect()->route('admin.subscriptionmenupermission')->with('error', 'Subscriber Permission not found.');
        }

        return view('subcription::subscriptionmenupermission.edit', compact('pagetitle', 'pageroot', 'username', 'usermenus', 'subscriberplans', 'subscriberPermission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subscriber_id' => 'required|integer',
            'menu_id' => 'required|integer',
            'access' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $subscriberPermission = SubscriberPlanMenu::find($id);
            if (!$subscriberPermission) {
                return redirect()->route('admin.subscriptionmenupermission')->with('error', 'Subscriber Permission not found.');
            }

            $subscriberPermission->subscriber_id = $request->subscriber_id;
            $subscriberPermission->menu_id = $request->menu_id;
            $subscriberPermission->access = $request->access;
            $subscriberPermission->status = 'Active';
            $subscriberPermission->delete_status = 0;
            $subscriberPermission->save();

            return redirect()->route('admin.subscriptionmenupermission')->with('success', 'Subscriber Permission updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the Subscriber Permission: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $subscriberPermission = SubscriberPlanMenu::find($id);
            $subscriberPermission->delete_status = 1;
            $subscriberPermission->save();
            return redirect()->route('admin.subscriptionmenupermission')->with('success', 'Subscriber Permission deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.subscriptionmenupermission')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $subscriberPermission = SubscriberPlanMenu::find($id);
        if (!$subscriberPermission) {
            return redirect()->route('admin.subscriptionmenupermission')->with('error', 'Subscriber Permission not found.');
        }
        $subscriberPermission->status = ($subscriberPermission->status === 'Active') ? 'Inactive' : 'Active';
        $subscriberPermission->save();

        return redirect()->route('admin.subscriptionmenupermission')->with('success', 'Subscriber Permission status successfully updated.');
    }
}
