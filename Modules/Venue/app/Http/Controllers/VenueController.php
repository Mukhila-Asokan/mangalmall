<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
Use Modules\Venue\Models\VenueDataField;
Use Modules\Venue\Models\VenueDataFieldDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueThemeBuilder;
use Modules\Venue\Models\VenueDetails;
use Modules\Venue\Models\VenueCampaigns;
use Modules\Venue\Models\Imagelibrary;
use Modules\VenueAdmin\Models\VenueUser;
use Modules\VenueAdmin\Models\VenueBooking;
use Modules\VenueAdmin\Models\VenueBookingDetails;
use Modules\Venue\Models\VenueContent;
Use Modules\Venue\Models\VenueImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

Use Modules\Venue\Models\State;
Use Modules\Venue\Models\District;
Use Modules\Venue\Models\City;
use Modules\Venue\Models\Area;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use DataTables;
use Session;
use Exception;

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
                        $btn = '';
                        if($row->status == 'Active') 
                        {
                            $btn .= '<a href="'.url('admin/venue/'.$row->id.'/updatestatus').'" class="btn btn-primary btn-sm" title="Status"><i class="tf-icon mdi mdi-eye"></i></a>';
                        }
                        else
                        {
                            $btn .= ' <a href="'.url('admin/venue/'.$row->id.'/updatestatus').'" class="btn-info btn btn-sm" title="Status"><i class="tf-icon mdi mdi-eye-off"></i></a>';
                        } 
       
                            $btn .= ' <a href="'.url('admin/venue/detailview/'.$row->id).'" class="edit btn btn-warning btn-sm"><i class="tf-icon mdi mdi-file-presentation-box"></i></a>';

                            $btn .= ' <a href="'.url('admin/venue/'.$row->id.'/destroy').'" class="btn-danger btn-sm btn" title="Delete"><i class="fa fa-trash action_icon"></i></a>';
      
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
        $contactMobile = ltrim($request->input('contactmobile'), '0'); 
        $request->merge(['contactmobile' => $contactMobile]);
        $validator = Validator::make($request->all(),[
            'venuename' => 'required',
            'venueaddress' => 'required',
            'locationid' => 'required',
            'description' => 'required',
            'contactperson' => 'required',
            'contactmobile' => 'required|unique:venuedetails|digits:10', 
            'venuetypeid' => 'required',         
           
         ]);

         if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $venuedetails = new VenueDetails;
        $venuedetails->venuename = $request->venuename;
        $venuedetails->venueaddress = $request->venueaddress;
        $venuedetails->locationid = $request->locationid;
        $venuedetails->description = $request->description;
        $venuedetails->contactperson = $request->contactperson;
        $venuedetails->contactmobile = $request->contactmobile;
        $venuedetails->contacttelephone = $request->contacttelephone  ?? '';
        $venuedetails->contactemail = $request->contactemail ?? '';
        $venuedetails->websitename = $request->websitename ?? '';
        $venuedetails->venuetypeid = $request->venuetypeid;
        $venuedetails->venuesubtypeid = 0;
        $venuedetails->bookingprice = $request->bookingprice;
        $venuedetails->budgetperplate = $request->budgetperplate ?? '';
        $venuedetails->capacity = $request->capacity;
        $venuedetails->food_type = $request->food_type;
        $venuedetails->is_worth = 'none';
        $venuedetails->googlemap = '-';

       /* $venuedetails->venueamenities = json_encode(array_map('intval', $request->venueamenities)); 
        $venuedetails->venuedata = json_encode(array_map('intval', $request->datafieldvalue));*/


        $venueamenities = $request->venueamenities ?? [];
        $venuedata = $request->datafieldvalue ?? [];

        if (!empty($venueamenities) && is_array($venueamenities)) {
            $venuedetails->venueamenities = json_encode(array_map('intval', $venueamenities));
        } else {
            $venuedetails->venueamenities = json_encode([]);
        }

        if (!empty($venuedata) && is_array($venuedata)) {
            $venuedetails->venuedata = json_encode(array_map('intval', $venuedata));
        } else {
            $venuedetails->venuedata = json_encode([]);
        }



    $filename = '';
       if ($request->hasFile('bannerimage')) {
        $filename = $request->file('bannerimage')->store('venuebannerimage', 'public_uploads');

        /*$filename = $request->file('bannerimage')->storeAs('venuebannerimage', time().'_'.$request->file('bannerimage')->getClientOriginalName(), 'public');*/
    }
    
       $venuedetails->bannerimage = $filename;
       $venuedetails->featured = 1;
       $venuedetails->status = 'Active'; 
       $venuedetails->delete_status = 0;


       try {
            $venuedetails->save();
        } catch (Exception $e) {          
             Log::error($e); // Log the entire exception object
             return redirect()->back()->with('error', $e->getMessage());
        }
      



       return redirect('admin/venue/show')->with('success', 'Venue  Details successfully created');

    }

    public function updatestatus($id)
    {
        $venuedetails = VenueDetails::where('id', '=', $id)->select('status')->first();
        $status = $venuedetails->status;
        $venuedetailsstatus = "Active";
        if($status == "Active") {
            $venuedetailsstatus = "Inactive";
        }
        VenueDetails::where('id', '=', $id)->update(['status' => $venuedetailsstatus]);
        return redirect('admin/venue/show')->with('success', 'Venue  status successfully updated');

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

        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue";
        $pageroot = "Home";
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::orderBy('City')->get();
        $venue = VenueDetails::where('id',$id)->first();
        return view('venue::venues.edit',compact('pagetitle','pageroot','username','venuetypes','venueamenities','venuedatafield','arealocation','venue'));
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'venuename' => 'required',
            'venueaddress' => 'required',
            'locationid' => 'required',
            'description' => 'required',
            'contactperson' => 'required',
            'contactmobile' => 'required|unique:venuedetails', 
            'venuetypeid' => 'required',         
           
         ]);

         if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }
   
        $venuedetails = VenueDetails::findOrFail($id);
        $venuedetails->venuename = $request->venuename;
        $venuedetails->venueaddress = $request->venueaddress;
        $venuedetails->locationid = $request->venuearea;
        $venuedetails->description = $request->description;
        $venuedetails->contactperson = $request->contactperson;
        $venuedetails->contactmobile = $request->contactmobile;
        $venuedetails->contacttelephone = $request->contacttelephone  ?? '';
        $venuedetails->contactemail = $request->contactemail ?? '';
        $venuedetails->websitename = $request->websitename ?? '';
        $venuedetails->venuetypeid = $request->venuetypeid;
        $venuedetails->venuesubtypeid = 0;
        $venuedetails->bookingprice = $request->bookingprice;
        $venuedetails->capacity = $request->capacity;
        
        $venuedetails->googlemap = '-';

        $venuedetails->venueamenities = json_encode(array_map('intval', $request->venueamenities)); 
        $venuedetails->venuedata = json_encode(array_map('intval', $request->datafieldvalue));

        
        if ($request->hasFile('bannerimage')) {
           $venuedetails->bannerimage = $request->file('bannerimage')->store('venuebannerimage', 'public_uploads'); 
           
        }

        $venuedetails->featured = 1;
        $venuedetails->status = 'Active'; 
        $venuedetails->delete_status = 0;


       try {
            $venuedetails->save();
        } catch (Exception $e) {          

             return redirect()->back()->with('error', $e->getMessage());
        } 
       return redirect('admin/venue/show')->with('success', 'Venue  Details successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VenueDetails::where('id', '=', $id)->update(['delete_status' => 1]);
        return redirect('admin/venue/show')->with('success', 'Venue  Details successfully deleted');
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
                 $filename = $request->file('upload_file')->store('uploads/medialibrary', 'public_uploads');;
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
                 $filename = $request->file('upload_file')->store('uploads/medialibrary', 'public_uploads');;
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

   

    public function webpage($id)
    {

       $venuecampaign = VenueCampaigns::where('venueid', $id)->latest()->first();

       echo $venuecampaign->template_html;
        
    }

    public function bookingdetails($id)
    {

        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue";
        $pageroot = "Home";
        $page = ["title" => "something"]; 
        
        $venue = VenueDetails::where('id',$id)->first();
        $venuebooking = VenueBooking::where('venue_id',$id)->get();

      /* return view('venue::venues.booking',compact('pagetitle','pageroot','username','venuebooking','venue','page'));*/


       return Inertia::render('Venue/VenueBookingCalendar', [
        'pagetitle' => $pagetitle,
        'pageroot' => $pageroot,
        'username' => $username,
        'venuebooking' => $venuebooking,
        'venue' => $venue,
        'page' => $page,       
    ]);
        
    }

    public function getBookings($id)
    {
         $month = $request->query('month', date('m'));
        $bookings = VenueBooking::where('venue_id',$id)->whereMonth('start_datetime', $month)->get();

        return response()->json($bookings);
    }

    public function venuecontent($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Content";
        $pageroot = "Venue"; 
        $venue = VenueDetails::where('id',$id)->first();
        $venuecontent = VenueContent::where('venue_id',$id)->first();       
        return view('venue::venues.venuecontent',compact('pagetitle','pageroot','username','venue','venuecontent'));
    }

    public function content_add(Request $request)
    {
        $id = $request->venue_id;
        $venue_content = VenueContent::where('venue_id',$id)->first(); 
        if ($venue_content !== null && count((array)$venue_content) > 0) { // Check for null first, then cast to array
            $venuecontent = VenueContent::find($venue_content->id);
        } else {
            $venuecontent = new VenueContent;
        }
        
        $venuecontent->venue_id = $id;
        $venuecontent->description = $request->description;
        $venuecontent->key_features = $request->key_features;
        $venuecontent->ambience = $request->ambience;
        $venuecontent->event_sustability = $request->event_sustability;
        $venuecontent->amenities = $request->amenities;
        $venuecontent->policy = $request->policy;       
        $venuecontent->save();
        return redirect()->back()->with('success', 'Venue Content successfully created');
    }
    public function venueimage($id)
    {
       
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Image";
        $pageroot = "Venue"; 
        $venue = VenueDetails::where('id',$id)->first();
        $venueimage = VenueImage::where('venue_id',$id)->get(); 
           
        return view('venue::venues.venueimage',compact('pagetitle','pageroot','username','venue','venueimage'));
    }
    public function venueimage_add(Request $request)
    {
        $id = $request->venue_id;

        $request->validate([
            'sliderimage.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'galleryimage.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'venue_id' => 'required|exists:venuedetails,id',
        ]);

        $venue = VenueDetails::find($request->venue_id);

        // Handle slider images
        if ($request->hasFile('sliderimage')) {
         
            foreach ($request->file('sliderimage') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('venue_images', $filename, 'public');

                $image_type = 'slider';

              $result =   VenueImage::create([
                    'venue_id' => $id,
                    'image_path' => $path,
                    'image_type' => $image_type,
                ]);
            }
        }

        // Handle gallery images
        if ($request->hasFile('galleryimage')) {
            foreach ($request->file('galleryimage') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('venue_images', $filename, 'public');

                VenueImage::create([
                    'venue_id' => $id,
                    'image_path' => $path,
                    'image_type' => 'gallery',
                ]);
            }
        }

        
       
        return redirect()->back()->with('success', 'Venue Image successfully created');
    }

    public function imageDelete(Request $request)
    {
        $image = VenueImage::find($request->id);

        if ($image) {
            // Delete image from storage
            Storage::delete('public/venue_images/' . $image->image_path);

            // Delete from database
            $image->delete();

            return response()->json(['success' => true, 'message' => 'Image deleted successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Image not found!']);
    }

    
    public function getDistricts(Request $request)
    {
        $districts = District::where('stateid', $request->state_id)
                            ->where('delete_status', 0)
                            ->get();
        
        return response()->json($districts);
    }


}
