<?php

namespace Modules\Subcription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Modules\Subcription\Models\SubscriptionPlan;
use Session;    

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Subscription";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Subscription Plan";
        $subscriptionPlans = SubscriptionPlan::where('delete_status', '0')->paginate(10);
        return view('subcription::subcriptionplan.index', compact('pagetitle', 'pageroot', 'subscriptionPlans', 'username'));
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Subscription";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Subscription Plan";
        return view('subcription::subcriptionplan.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return view('subcription::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
