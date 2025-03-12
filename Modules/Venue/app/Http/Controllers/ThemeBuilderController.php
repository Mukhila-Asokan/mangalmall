<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Venue\Models\VenueThemeBuilder;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use ZipArchive;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ThemeBuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Theme Builder";
        $pageroot = "Venue";
        $venuethemebuilder = VenueThemeBuilder::where('delete_status',0)->get();

         if ($request->ajax()) {

             $data = VenueThemeBuilder::where('delete_status',0)->get();

               return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('theme_type',function($row)
                    {
                        return $row->theme_type == 1 ? 'One Page' : 'Multiple Page';
                    })
                    ->addColumn('preview_image',function($row)
                    {
                        $preview_imageurl = url("admin/venue/themebuilder/".$row->id."/preview");
                        $url = url('/').Storage::url('/');
                        $image = '<a href = "'.$preview_imageurl.'" target = "_new"><img src="'.$url.$row->preview_image.'" width="100px"/></a>';
                         return $image;
                    })
                    ->addColumn('action', function($row){

                        if($row->status == 'Active')
                        {
                            $btn = "<button type='button' class='btn btn-primary statusid' data-bs-toggle='modal'  data-bs-target='.statusModal'  data-id=".$row->id." title='Status'><i class='fa fa-eye action_icon'></i></button> ";
                        }
                        else
                        {
                            $btn = "<button type='button' class='btn-info btn statusid' data-bs-toggle='modal' data-bs-target='.statusModal' data-id=".$row->id." title='Status'><i class='fa fa-eye-slash action_icon'></i></button> ";
                        }
                        
                            $btn .= "<a href=".url('admin/venue/themebuilder/'.$row->id.'/edit')." class='btn-warning btn' title='Edit'><i class='fa fa-pencil action_icon'></i></a> <input type='hidden' name='selectedid' id='selectedid' value='".$row->id."'><input type='hidden' name='statusselectedid' id='statusselectedid' value='".$row->id."'>";

                            $btn .= "<button type='button' class='btn-danger btn deleteid' data-bs-toggle='modal'  data-bs-target='#delModal' data-id=".$row->id." title='Delete'><i class='fa fa-trash action_icon'></i></button> ";
      
                            return $btn;
                    })
                    ->rawColumns(['theme_type','preview_image','action'])
                    ->make(true);
         }
         $pageurl = route('venue');
         return view('venue::themebuilder.index', compact('pagetitle','pageroot','username','venuethemebuilder','pageurl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Theme Builder";
         $pageroot = "Venue";
         
        return view('venue::themebuilder.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'themename' => 'required',
            'theme_zipfile' => 'required',
            'theme_type' => 'required',
            'preview_image' => 'required',           
         ]);

        $themebuilder = new VenueThemeBuilder;
        $themebuilder->themename = $request->themename;
        $themebuilder->theme_type = $request->theme_type;

        $filename = '';
        if($request->hasFile('theme_zipfile')){               
            $filename = $request->file('theme_zipfile')->store('template_zips', 'public');
             $zip = new ZipArchive;
                
             $pathname = base_path().'/public/storage/'.$filename; 

             $cleanedString = str_replace(' ', '', $request->themename); 
             $cleanedString = trim($cleanedString);
             $randomNumber = rand(1, 100); 
            $extractpath = base_path().'/public/storage/template/unzipped/'.$cleanedString.$randomNumber;
            $zip_path = '/storage/template/unzipped/'.$cleanedString.$randomNumber;
            
        if ($zip->open($pathname) === TRUE) {
            
            $zip->extractTo($extractpath); // Extract files to the 'unzipped' directory
            $zip->close();

        }}
       
        $themebuilder->theme_zipfile = $filename;
        $themebuilder->zip_path = $zip_path;

        $filename1 = '';
        if($request->hasFile('preview_image')){               
            $filename1 = $request->file('preview_image')->store('preview_image', 'public');

        }
        $themebuilder->preview_image = $filename1;
        $themebuilder->save();

        return redirect('admin/venue/themebuilder')->with('success', 'New Theme  successfully uploaded');

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('venue::show');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VenueThemeBuilder::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/venue/themebuilder')->with('success', 'Venue Theme Builder successfully deleted');
    }

    public function updatestatus($id) {
        $venuetype = VenueThemeBuilder::where('id', '=', $id)->select('status')->first();        
        $status = $venuetype->status;
        $venuetypestatus = "Active";
        if($status == "Active") {
            $venuetypestatus = "Inactive";
        }
        VenueThemeBuilder::where('id', '=', $id)->update(['status' => $venuetypestatus]);
        return redirect('admin/venue/themebuilder')->with('success', 'Venue Theme Builder status successfully updated');
    }

    public function preview($id)
    {
       
        $theme = VenueThemeBuilder::where('id', '=', $id)->first();
        $themefullpath = $theme->zip_path;
        $pathurl = url('/').$themefullpath.'/index.html';  
       
        $url = url('/').$themefullpath;
        return redirect()->away($pathurl); 
    }
}
