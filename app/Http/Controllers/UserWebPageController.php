<?php

namespace App\Http\Controllers;

use App\Models\UserWebPage;
use App\Models\UserWebPageData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use App\Models\OccasionType;
use App\Models\OccasionDataField;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Modules\Invitation\Models\InvitationWebpage;
use Svg\Tag\Rect;

class UserWebPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $occasiontype = OccasionType::where('delete_status','0')->get();
        
        return view('home.userwebpage',compact('occasiontype'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->all();

        $userwebpage = new UserWebPage();
        $userwebpage->userid = Auth::user()->id;
        $userwebpage->occasion_id = $request->occasion_type;
        $userwebpage->validupto = now()->addDays(30);
        $userwebpage->status = 'Active';
        $userwebpage->delete_status = 0;
        $userwebpage->save();

        foreach ($request->data_fields as $key => $value) {
            $userpagedata = new UserWebPageData();
            $userpagedata->userid = Auth::user()->id;
            $userpagedata->webpage_id = $userwebpage->id;
            $userpagedata->datafield_id = $key;
            $userpagedata->datafield_value = $value;
            $userpagedata->save();
        }

        return redirect()->route('user.webpage.template')->with('Success','Web Page Data successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function template(Request $request)
    {
        $userwebpages = UserWebPage::where('userid', Auth::user()->id)->get();
        return view('home.userwebpage_template',compact('userwebpages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserWebPage $userWebPage)
    {
        //
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
    public function destroy(UserWebPage $userWebPage)
    {
        //
    }

    public function getoccasionfields($id)
    {
        $datafield = OccasionDataField::where('occasion_id', $id)->get();
    
        if ($datafield->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }
    
        return response()->json($datafield, 200);
    }

    public function showtemplate()
    {
        $template = InvitationWebpage::where('delete_status', 0)->get();
        return view('home.userwebpage_template', compact('template'));
    }

    public function preview($id)
    {       
        $template = InvitationWebpage::where('id', $id)->first();
        $themefullpath = $template->pathname;
        $pathurl = url('/').$themefullpath.'/index.html'; 
        $url = url('/').$themefullpath;
        return redirect()->away($pathurl); 
    }
    public function themeeditor($userid,$id)  
    {
        $theme = InvitationWebpage::where('id', $id)->first();
        $userWebPage = UserWebPage::where('userid', $userid)->where('occasion_id', '40')->first();
        $occasiondata = OccasionDataField::where('occasion_id', '40')->get();
        $webpagedata = UserWebPageData::where('webpage_id', $id)->get();
        $themefullpath = $theme->pathname;  
        $pathurl = url('/').$themefullpath.'/index.html';
        return view('home.showwebpage',compact('pathurl','userid','id','theme','themefullpath','webpagedata','userWebPage'));
    }

}
