<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\VenueAdmin\Models\VenueUser;
use Illuminate\Support\Facades\Validator;
use session;
use Auth;


class VenueAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('venueadmin::auth.login');
    }

    public function mobileotp(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'mobileno' => 'required', 'string', 'regex:/^[0-9]{10}$/'
        ]);

      

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }

        $mobilenocheck = VenueUser::where('mobileno',$request->mobileno)->first();

        if(!empty($mobilenocheck))
        {
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'OTP Send your mobile, Please check';
        }
        else
        {
            $browserResponse['status']   = 'failed';
            $browserResponse['message']  = 'Please check your mobile no';
        }

       
        return response()->json($browserResponse, 200);
    }


    public function sendotp(Request $request)
    {
         $request->validate([
            'mobileno' => 'required|string|regex:/^[0-9]{10}$/|unique:venueuser',
            'yourname' => 'required',
            'venuecity' => 'required'
        ],[
        'yourname.required' => 'Your name is required, Please enter.',
        ]);

       /* if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }*/

        $browserResponse['status']   = 'success';
        $browserResponse['message']  = 'OTP Send your mobile, Please check';

        return response()->json($browserResponse, 200);
    }

    public function newaccountadd(Request $request)
    {
        $newvenue = new VenueUser();
        $newvenue->name = $request->yourname;
        $newvenue->mobileno = $request->mobileno ;
        $newvenue->city = $request->venuecity ;
        $newvenue->email = 'admin@gmail.com' ;
        $newvenue->role = 'Venue Admin' ;
        $newvenue->status = 'Inactive';
        $newvenue->save();

        return redirect('venue/login')->with('success', 'Registered Successfully, Please login in');
    }

    public function logincheck(Request $request)
    {
        $request->validate([
            'mobileno' => 'required', 'string', 'regex:/^[0-9]{10}$/',
            'mobileotp' => 'required'
        ]);

        $mobilenocheck = VenueUser::where('mobileno',$request->mobileno)->first();



        if(!empty($mobilenocheck))
        {
             $request->session()->put('mobile_verified', true);
            if($mobilenocheck->status == "Inactive")
            {
                return redirect('venueadmin/inactiveuser')->with('success', 'Please contact Mangal Mall team to activate your account');
            }
            else
            {
                return redirect('venueadmin/dashboard')->with('success', 'Welcome to the dashboard');
            }
        }



        return redirect('venue/login')->with('error', 'Please check your mobile no');
    }

    public function inactiveuser()
    {
        return view('venueadmin::auth.inactiveuser');
    }

    public function dashboard()
    {
      
         return view('venueadmin::auth.dashboard');
    }  

    public function register()
    {
      
         return view('venueadmin::auth.register');
    }    
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venueadmin::create');
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
        return view('venueadmin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('venueadmin::edit');
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
    public function destroy(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/venue/login'); 
    }
}
