<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
Use Modules\Venue\Models\VenueDataField;
Use Modules\Venue\Models\VenueDataFieldDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueGalleryImage;
use Modules\Venue\Models\VenueThemeBuilder;
use Modules\Venue\Models\VenueDetails;
use Modules\Venue\Models\VenueCampaigns;
use Modules\Venue\Models\Imagelibrary;
use Modules\VenueAdmin\Models\VenueUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use DataTables;
use Session;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue List";
        $pageroot = "Venue"; 
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::where('delete_status',0)->get();


        if ($request->ajax()) {

            $data = VenueDetails::where('delete_status',0)->get();


            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="'.url('admin/venue/detailview/'.$row->id).'" class="edit btn btn-primary btn-sm">View</a>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
          



        return view('venue::venues.show',compact('pagetitle','pageroot','username','venuetypes','venueamenities','venuedatafield','arealocation'));
    }

    public function venuesettings()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Settings";
        $pageroot = "Venue";        
        return view('venue::venuesettings',compact('pagetitle','pageroot','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue";
        $pageroot = "Home";
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::orderBy('City')->get();
        return view('venue::venues.create',compact('pagetitle','pageroot','username','venuetypes','venueamenities','venuedatafield','arealocation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'venuename' => 'required',
            'venueaddress' => 'required',
            'locationid' => 'required',
            'description' => 'required',
            'contactperson' => 'required',
            'contactmobile' => 'required',
            'contacttelephone' => 'required',
            'contactemail' => 'required',
            'websitename' => 'required',
            'venuetypeid' => 'required',
            'venuesubtypeid' => 'required',
           
         ]);
        $venuedetails = new VenueDetails;
        $venuedetails->venuename = $request->venuename;
        $venuedetails->venueaddress = $request->venueaddress;
        $venuedetails->locationid = $request->locationid;
        $venuedetails->description = $request->description;
        $venuedetails->contactperson = $request->contactperson;
        $venuedetails->contactmobile = $request->contactmobile;
        $venuedetails->contacttelephone = $request->contacttelephone;
        $venuedetails->contactemail = $request->contactemail;
        $venuedetails->websitename = $request->websitename;
        $venuedetails->venuetypeid = $request->venuetypeid;
        $venuedetails->venuesubtypeid = $request->venuesubtypeid;

        $venueamenities = json_encode($request->venueamenities);
        $venuedetails->venueamenities = $venueamenities;
        $venuedatafield = $request->datafieldid;
        $venuedatavalue = $request->datafieldvalue;
        
         
       $veneudata = json_encode($venuedatavalue);
    

        $filename = '';
        if($request->hasFile('bannerimage')){         
            $filename = $request->file('bannerimage')->store('venuebannerimage', 'public');;

        }

       $venuedetails->venuedata = $veneudata;
       $venuedetails->bannerimage = $filename;

   
       $venuedetails->save();



       return redirect('admin/venue/show')->with('success', 'Venue  Details successfully created');

    }

    /**
     * Show the specified resource.
     */

    public function detailview($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Detailed View";
        $pageroot = "Venue"; 
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();         
        $venuedatafielddetails = VenueDataFieldDetails::where('delete_status',0)->get();         
        $venuedetails = VenueDetails::where('id',$id)->first();
        return view('venue::venues.detailview',compact('pagetitle','pageroot','username','venuedetails','venueamenities','venuedatafield','venuedatafielddetails'));
    }


    public function themebuilder($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Detailed View";
        $pageroot = "Venue"; 
        $venueid = $id;
        $theme = VenueThemeBuilder::where('delete_status',0)->get();
        return view('venue::venues.themelistview',compact('pagetitle','pageroot','username','theme','venueid'));
    }

    public function themeeditor($venueid,$id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');   
        $venueid =  $venueid;
        $themeid = $id;
        $pagetitle = "Theme View";
        $pageroot = "Venue"; 
        $venue = VenueDetails::where('id',$venueid)->first();
        $theme = VenueThemeBuilder::where('id',$id)->first();
        $template = VenueCampaigns::where('venueid',$venueid)->where('theme_id',$id)->first();
        $themefullpath = $theme->zip_path;
        $pathurl = url('/').$themefullpath.'/index.html'; 
       
       

       return view('venue::venues.showvenuetheme',compact('pagetitle','pageroot','username','userid','theme','venue','pathurl','template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('venue::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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

    public function ajaxcitylist(Request $request)
    {
        $area_id = $request->area_id;
        $arealocation = indialocation::where('id','=',$area_id)->get();

        return response()->json($arealocation, 200);
    }
    public function ajaxcvenuesubtypelist(Request $request)
    {
        $venuetypeid = $request->venuetypeid;
        $venuesubtype = VenueType::where('roottype','=',$venuetypeid)->get();
        return response()->json($venuesubtype, 200);
    }
    public function updatetheme_venue(Request $request)
    {
       $template_id = $request->template_id;
        $html = $request->template_content;
        $venueid = $request->venueid;
        $venuename = $request->venuename;
        $themname = $request->themname;
        $venuecampaign = new VenueCampaigns;
        $venuecampaign->venueid = $venueid;
        $venuecampaign->venuename = $venuename;
        $venuecampaign->theme_id = $template_id;
        $venuecampaign->themename = $themname;
        $venuecampaign->custom_css = $request->custom_css ?? '-';
        $venuecampaign->custom_js = $request->custom_js  ?? '-';
        $venuecampaign->template_html = $html;  

        $venuecampaign->save();
        $upload_path = $this->createTemplateDirectory($venueid);
        $p = $upload_path.time().'.html';
        file_put_contents($p, $html);

        $browserResponse['status']   = 'success';
        $browserResponse['message']  = 'Template updated successfully';
        return response()->json($browserResponse, 200);

    }

    public function saveMyTemplate(Request $request)
    {
        $template_id = $request->template_id;
        $html = $request->template_content;
        $venueid = $request->venueid;
        $venuename = $request->venuename;
        $themname = $request->themname;
        $venuecampaign = new VenueCampaigns;
        $venuecampaign->venueid = $venueid;
        $venuecampaign->venuename = $venuename;
        $venuecampaign->theme_id = $template_id;
        $venuecampaign->themename = $themname;
        $venuecampaign->custom_css = $request->custom_css ?? '-';
        $venuecampaign->custom_js = $request->custom_js  ?? '-';
        $venuecampaign->template_html = $html;  

        $venuecampaign->save();
        $upload_path = $this->createTemplateDirectory($venueid);
        $p = $upload_path.time().'.html';
        file_put_contents($p, $html);

        $browserResponse['status']   = 'success';
        $browserResponse['message']  = 'Template updated successfully';
        return response()->json($browserResponse, 200);

    }

    function createTemplateDirectory($venueid){  
        $upload_path = public_path('storage/uploads/sites/venue'.$venueid.'/');
        $checkPath   = public_path('storage/uploads/sites/venue'.$venueid.'/');

        if(!File::exists($checkPath)) {
            File::makeDirectory($upload_path, 0755, true); 
        }
        return $upload_path;
    }

    public function upload_image(Request $request)
    {
          
            $uuid = Str::uuid(); 

            $resData = "";
            $filename = "";
            if($request->hasFile('upload_file')){   
                 $filename = $request->file('upload_file')->store('uploads/medialibrary', 'public');;
            }
            if($filename != '')
            {
               $url = url('/').Storage::url('/').$filename;
             

                 $imgLibrary = new Imagelibrary;
                 $imgLibrary->uid =  $uuid;
                 $imgLibrary->url =  $url;
                 $imgLibrary->title =  $filename;
                 $imgLibrary->source =  'custom';
                 
                 $imgLibrary->save();


                $lastInsertedId = $imgLibrary->id;
                $resData = array('status' => 1 , 'data' => $url, 'title'=>$filename, 'id' =>$lastInsertedId);
            }

            /*$resData = array('status' => 1 , 'data' => 'https://mighteee.app/uploads/medialibrary/4ef4c9a2de_2.png' , 'title'=>'favicon.png' , 'id' =>8);*/

          

            return response()->json($resData, 200);
    }

    public function load_media_library_img(Request $request)
    {
        $uuid = Str::uuid();
        
        /*if(isset($request->searchTerm) && $request->searchTerm !=''){
                $campaign_name = $request->searchTerm;
                $Cond .= " AND title LIKE '%$campaign_name%'";
        }*/

        /*$imgLibrary = DB::table('imagelibrary')->where('uid',$uuid)->get();*/


       
        $imgLibrary = Imagelibrary::latest()->get();
        $imglibMsg = 'No more images in your Image Library There is not any images in your Library';
        $libData = '';
        
        if($imgLibrary){
            foreach($imgLibrary as $imgData){
                
                $libData .= '<li><a href="javascript:;"><img src="'.$imgData->url.'" alt="image"/ class="mt_use_img" data-type="'.$request->img_container_id.'" ></a></li>'; 
            }
        }else{
            $libData .= '<li>'.$imglibMsg.'</li>';
        }
       
        $resData = array('status' => 1 , 'data' => $libData , 'pagination' => 1);
         return response()->json($resData, 200);

    }
    public function load_api_img(Request $request)
    {
        $uuid = Str::uuid();
        $imgLibrary = Imagelibrary::all();

        $imglibMsg = 'No more images in your Image Library There is not any images in your Library';
        $libData = '';
        
        if($imgLibrary){
            foreach($imgLibrary as $imgData){
                
                $libData .= '<li><a href="javascript:;"><img src="'.$imgData->url.'" alt="image"/ class="mt_use_img" data-type="'.$request->img_container_id.'" ></a></li>'; 
            }
        }else{
            $libData .= '<li>'.$imglibMsg.'</li>';
        }
       
        $resData = array('status' => 1 , 'data' => $libData , 'pagination' => 10);
         return response()->json($resData, 200);

    }
    public function uploadImageUrl(Request $request)
    {
        $uuid = Str::uuid(); 

            $resData = "";
            $filename = "";
            if($request->hasFile('upload_file')){   
                 $filename = $request->file('upload_file')->store('uploads/medialibrary', 'public');;
            }
            if($filename != '')
            {
               $url = url('/').Storage::url('/').$filename;
             

                 $imgLibrary = new Imagelibrary;
                 $imgLibrary->uid =  $uuid;
                 $imgLibrary->url =  $url;
                 $imgLibrary->title =  $filename;
                 $imgLibrary->source =  'pixabay';
                 
                 $imgLibrary->save();


                $lastInsertedId = $imgLibrary->id;
                $resData = array('status' => 1 , 'data' => $url, 'title'=>$filename, 'id' =>$lastInsertedId);
            }

            /*$resData = array('status' => 1 , 'data' => 'https://mighteee.app/uploads/medialibrary/4ef4c9a2de_2.png' , 'title'=>'favicon.png' , 'id' =>8);*/

          

            return response()->json($resData, 200);
    }

    public function venueportalrequest()
    {
        $venueuser = VenueUser::where('status','Inactive')->paginate(20);
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue User Request";
        $pageroot = "Venue";        
        return view('venue::venueportalrequest',compact('pagetitle','pageroot','username','venueuser'));

    }
    public function venueuserupdatestatus($id)
    {
        $venueuser = VenueUser::where('id', '=', $id)->select('status')->first();
        $status = $venueuser->status;
        $venueuserstatus = "Active";
        if($status == "Active") {
            $venueuserstatus = "Inactive";
        }
        VenueUser::where('id', '=', $id)->update(['status' => $venueuserstatus]);
        return redirect('admin/venueportalrequest')->with('success', 'Venue User status successfully activatied');

    }

}
