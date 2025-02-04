<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Session;

class RoleController extends Controller
{
    public function redirectRoutes()
    {
       
        Session::put('username', Auth::guard('admin')->user()->name);
        Session::put('userrole', Auth::guard('admin')->user()->role);
        Session::put('userid', Auth::guard('admin')->user()->id);

        \Log::info('Admin session:', Session::all());

        if (Auth::guard('admin')->user() && Auth::guard('admin')->user()->role != 'Staff')
        {
            return redirect('admin/dashboard');
        }
        elseif(Auth::guard('admin')->user() && Auth::guard('admin')->user()->role == 'Staff')
        {
            return redirect('admin/staff/dashboard');
        }
        return redirect(route('admin.login'));

     
    }
}
