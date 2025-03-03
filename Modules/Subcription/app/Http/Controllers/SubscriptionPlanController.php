<?php

namespace Modules\Subcription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Modules\Subcription\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subscribers_plans',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $subscriptionPlan = new SubscriptionPlan();
            $subscriptionPlan->name = $request->input('name');
            $subscriptionPlan->description = $request->input('description');
            $subscriptionPlan->price = $request->input('price');
            $subscriptionPlan->duration = $request->input('duration');
            $subscriptionPlan->status = 'Active';
            $subscriptionPlan->delete_status = 0;
            $subscriptionPlan->save();
            return redirect('admin/subscription/subscriptionplan')->with('success', 'Subscription plan created successfully.');
        } catch (\Exception $e) {
            return redirect('admin/subscription/subscriptionplan')->with('error', $e->getMessage());
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
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Edit Subscription Plan";
        $plan = SubscriptionPlan::findOrFail($id);
        return view('subcription::subcriptionplan.edit', compact('pagetitle', 'pageroot', 'username', 'plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subscribers_plans,name,' . $id,
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $subscriptionPlan = SubscriptionPlan::findOrFail($id);
            $subscriptionPlan->name = $request->input('name');
            $subscriptionPlan->description = $request->input('description');
            $subscriptionPlan->price = $request->input('price');
            $subscriptionPlan->duration = $request->input('duration');
            $subscriptionPlan->status = 'Active';
            $subscriptionPlan->delete_status = 0;
            $subscriptionPlan->save();
            return redirect('admin/subscription/subscriptionplan')->with('success', 'Subscription plan updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/subscription/subscriptionplan')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $subscriptionPlan = SubscriptionPlan::find($id);
            $subscriptionPlan->delete_status = 1;
            $subscriptionPlan->save();
            return redirect('admin/subscription/subscriptionplan')->with('success', 'Subscription plan deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/subscription/subscriptionplan')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $subscriptionPlan = SubscriptionPlan::find($id);
        if (!$subscriptionPlan) {
            return redirect('admin/subscription/subscriptionplan')->with('error', 'Subscription Plan not found.');
        }
        $subscriptionPlan->status = ($subscriptionPlan->status === 'Active') ? 'Inactive' : 'Active';
        $subscriptionPlan->save();

        return redirect('admin/subscription/subscriptionplan')->with('success', 'Subscription Plan status successfully updated.');
    }
}
