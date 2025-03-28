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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Invitation\Models\InvitationWebpage;
use Svg\Tag\Rect;
use App\Models\UserImageLibrary as Imagelibrary;
use App\Models\UserCampaign;

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
        $userid = Auth::user()->id;
        $usercampaign = UserCampaign::where('userid', $userid)->where('theme_id', $id)->first();
        if($usercampaign)
        {
            $html = $usercampaign->template_html;
            echo $html;
        }
        else
        {
            $template = InvitationWebpage::where('id', $id)->first();
            $themefullpath = $template->pathname;
            $pathurl = url('/').$themefullpath.'/index.html'; 
            $url = url('/').$themefullpath;
            return redirect()->away($pathurl); 
        }
    
    }
    public function themeeditor($userid,$id)  
    {
        $usercampaign = UserCampaign::where('userid', $userid)->where('theme_id', $id)->first();

        if($usercampaign)
        {
            $template = $usercampaign;
            $theme = InvitationWebpage::where('id', $id)->first();
            $userWebPage = UserWebPage::where('userid', $userid)->where('occasion_id', '40')->first();           
            $webpagedata = UserWebPageData::where('webpage_id', $id)->get();
            $themefullpath = $theme->pathname;  
            $pathurl = url('/').$themefullpath.'/index.html';
        }
        else
        {
            $template = '';
            $theme = InvitationWebpage::where('id', $id)->first();
            $userWebPage = UserWebPage::where('userid', $userid)->where('occasion_id', '40')->first();           
            $webpagedata = UserWebPageData::where('webpage_id', $id)->get();
            $themefullpath = $theme->pathname;  
            $pathurl = url('/').$themefullpath.'/index.html';
        }

       
        return view('home.showwebpage',compact('pathurl','userid','id','template','theme','themefullpath','webpagedata','userWebPage'));
    }
    public function load_media_library_img(Request $request)
    {
        $userid = Auth::user()->id;
        $imgLibrary = Imagelibrary::where('userid',$userid)->latest()->get();       
        $imglibMsg = 'No more images in your Image Library There is not any images in your Library';
        $libData = '';
        
        if($imgLibrary){
            foreach($imgLibrary as $imgData){
                
                $libData .= '<li><a href="javascript:;"><img src="'.$imgData->image_path.'" alt="image" class="mt_use_img" data-type="'.$request->img_container_id.'" ></a></li>'; 
            }
        }else{
            $libData .= '<li>'.$imglibMsg.'</li>';
        }
       
        $resData = array('status' => 1 , 'data' => $libData , 'pagination' => 1);
         return response()->json($resData, 200);
    }

    public function fileupload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if ($request->hasFile('file')) {
            $imageName = $request->file('file')->store('uploads/medialibrary', 'public_uploads');
            $url = url('/').'/'.$imageName;
        }

        if($imageName != '')
        {
           $url = url('/').Storage::url('/').$imageName;
         
        $imgLibrary = new Imagelibrary();
        $imgLibrary->userid = Auth::user()->id;
        $imgLibrary->image_name = 'uploads/'.$imageName;
        $imgLibrary->image_path = $url;      
        $imgLibrary->source = 'user';
        $imgLibrary->save();
        $lastInsertedId = $imgLibrary->id;
        $resData = array('status' => 1 , 'data' => $url, 'title'=>$imageName, 'id' =>$lastInsertedId);

        }
        return response()->json(['success' => 'You have successfully uploaded the image.', 'data' => $resData], 200);
    }


    public function load_api_img(Request $request)
    {
        $userid = Auth::user()->id;
        $imgLibrary = Imagelibrary::where('userid',$userid)->latest()->get();
       
        $imglibMsg = 'No more images in your Image Library There is not any images in your Library';
        $libData = '';
        
        if($imgLibrary){
            foreach($imgLibrary as $imgData){
                
                $libData .= '<li><a href="javascript:;"><img src="'.$imgData->image_path.'" alt="image"/ class="mt_use_img" data-type="'.$request->img_container_id.'" ></a></li>'; 
            }
        }else{
            $libData .= '<li>'.$imglibMsg.'</li>';
        }
       
        $resData = array('status' => 1 , 'data' => $libData , 'pagination' => 10); 
         return response()->json($resData, 200);

    }

    public function saveMyTemplate(Request $request)
    {
        $userid = Auth::user()->id;
        $template_id = $request->template_id;
        $html = $request->template_content;
       

        $template_id = $request->input('template_id');
        $themname = $request->input('themname');
        $html = $request->input('template_content');

        $usercampaign = UserCampaign::where('userid', $userid)->where('theme_id', $template_id)->first();

        if($usercampaign){
            $usercampaign->template_html = $html;
            $usercampaign->save();
            $upload_path = $this->createTemplateDirectory($userid);
            $p = $upload_path.time().'.html';
            file_put_contents($p, $html);
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'Template updated successfully';
            return response()->json($browserResponse, 200);
        }else
        {
            $usercampaign = new UserCampaign;
            $usercampaign->userid = $userid;
            $usercampaign->validupto = now()->addDays(30);
            $usercampaign->occasion_id = 1;
            $usercampaign->theme_id = $template_id;
            $usercampaign->themename = $themname;
            $usercampaign->custom_css = $request->custom_css ?? '-';
            $usercampaign->custom_js = $request->custom_js  ?? '-';
            $usercampaign->template_html = $html;  
            $usercampaign->status = 'Active';
            $usercampaign->delete_status = 0;
            $usercampaign->save();
            $upload_path = $this->createTemplateDirectory($userid);
            $p = $upload_path.time().'.html';
            file_put_contents($p, $html);
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'Template updated successfully';
            return response()->json($browserResponse, 200);
        }

    }

    function createTemplateDirectory($userid){  
        $upload_path = public_path('storage/uploads/sites/user'.$userid.'/');
        $checkPath   = public_path('storage/uploads/sites/user'.$userid.'/');

        if(!File::exists($checkPath)) {
            File::makeDirectory($upload_path, 0755, true); 
        }
        return $upload_path;
    }
    public function upload_image(Request $request)
    {

    }

    public function uploadImageUrl(Request $request)
    {
        
    }

}
