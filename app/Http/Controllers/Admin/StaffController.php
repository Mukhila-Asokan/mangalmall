<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class StaffController extends Controller
{
    public function index()
    {
        $pagetitle = "Dashboard";
         $pageroot = "Home";
         return view('admin.dashboard', compact('pagetitle','pageroot'));
    }
}
