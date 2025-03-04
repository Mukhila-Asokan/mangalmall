<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Subcription\Models\SubscriptionPlan;    

class PricingController extends Controller
{
    public function index()
    {
        $subcriberplan = SubscriptionPlan::where('delete_status', 0)->orderby('id','desc')->get();
      
        return view('pricing', compact('subcriberplan'));
       
    }   
}
