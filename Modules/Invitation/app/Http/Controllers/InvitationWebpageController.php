<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invitation\Models\InvitationWebpage;
use Illuminate\Support\Facades\Validator;
Use App\Models\OccasionType;
Use Session;
use ZipArchive;

class InvitationWebpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Webpage";
        $invitationwebpage = InvitationWebpage::where('delete_status', '0')->paginate(10);
        return view('invitation::invitationwebpage.index', compact('pagetitle', 'pageroot', 'invitationwebpage', 'username'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Webpage";
        $occasiontype = OccasionType::where('delete_status', '0')->get();
        return view('invitation::invitationwebpage.create', compact('pagetitle', 'pageroot', 'username', 'occasiontype'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'webpagename' => 'required|unique:invitationwebpage',
            'preview_image' => 'required|image',
            'occasiontype' => 'required',
            'pathname' => 'required|file|mimes:zip'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
           


            if ($request->hasFile('preview_image')) {
                $image = $request->file('preview_image');            
                $imagePath = $image->store('images', 'public_uploads');
              
            }
        
            if ($request->hasFile('pathname')) {
                $filename = $request->file('pathname')->store('template_zips', 'public_uploads');
                $zip = new ZipArchive;
            
                $pathname = public_path('storage/' . $filename);
                $cleanedString = str_replace(' ', '', trim($request->webpagename));
                $randomNumber = rand(1, 100);
            
                $extractPath = public_path('storage/template/unzipped/' . $cleanedString . $randomNumber);
                $zip_url_path = '/storage/template/unzipped/' . $cleanedString . $randomNumber;

                if (!file_exists($extractPath)) {
                    mkdir($extractPath, 0755, true);
                }
                
                $zip = new ZipArchive; 
                if ($zip->open($pathname) === TRUE) {
                    $zip->extractTo($extractPath);
                    $zip->close();

                    $invitationwebpage = new InvitationWebpage();
                    $invitationwebpage->webpagename = $request->webpagename;
                    $invitationwebpage->preview_image = $imagePath;
                    $invitationwebpage->occasion_id = $request->occasiontype;
                    $invitationwebpage->theme_zipfile = $filename;
                    $invitationwebpage->pathname = $zip_url_path;
                    $invitationwebpage->status = 'Active';
                    $invitationwebpage->delete_status = 0;
                    $invitationwebpage->save();

                } else {
                    throw new \Exception('Failed to open the zip file at: ' . $pathname);
                }
            }

            return redirect('admin/invitation/webpage')->with('success', 'Invitation Webpage added successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/webpage')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('invitation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Edit Invitation Webpage";
        $webpage = InvitationWebpage::find($id);
        $occasiontype = OccasionType::where('delete_status', '0')->get();
        return view('invitation::invitationwebpage.edit', compact('pagetitle', 'pageroot', 'webpage', 'username', 'occasiontype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'webpagename' => 'required|unique:invitationwebpage,webpagename,' . $id,
            'preview_image' => 'sometimes|image',
            'occasiontype' => 'required',
            'pathname' => 'sometimes|file|mimes:zip'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $invitationwebpage = InvitationWebpage::findOrFail($id);
            $invitationwebpage->webpagename = $request->webpagename;
            $invitationwebpage->occasion_id = $request->occasiontype;

            if ($request->hasFile('preview_image')) {
                $image = $request->file('preview_image');            
                $imagePath = $image->store('images', 'public');
                $invitationwebpage->preview_image = $imagePath;
            }
            
            if ($request->hasFile('pathname')) {
                $filename = $request->file('pathname')->store('template_zips', 'public');
                $zip = new ZipArchive;
            
                $pathname = storage_path('app/public/'.$filename);
                $cleanedString = str_replace(' ', '', $request->webpagename);
                $cleanedString = trim($cleanedString);
                $randomNumber = rand(1, 100);
            
                $extractPath = storage_path('app/public/template/unzipped/'.$cleanedString.$randomNumber);
                $zip_url_path = '/storage/template/unzipped/'.$cleanedString.$randomNumber; // Accessible path
            
                if ($zip->open($pathname) === TRUE) {
                    $zip->extractTo($extractPath);
                    $zip->close();
            
                    $invitationwebpage->theme_zipfile = $filename;
                    $invitationwebpage->pathname = $zip_url_path;
                } else {
                    throw new \Exception('Failed to open the zip file.');
                }
            }

            $invitationwebpage->status = 'Active';
            $invitationwebpage->delete_status = 0;
            $invitationwebpage->save();

            return redirect('admin/invitation/webpage')->with('success', 'Invitation Webpage updated successfully.');
        }
        catch (\Exception $e) {
            return redirect('admin/invitation/webpage')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $invitationwebpage = InvitationWebpage::find($id);
            $invitationwebpage->delete_status = 1;
            $invitationwebpage->save();
            return redirect('admin/invitation/webpage')->with('success', 'Invitation Webpage deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/webpage')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $invitationwebpage = InvitationWebpage::find($id);
        if (!$invitationwebpage) {
            return redirect('admin/invitation/webpage')->with('error', 'Invitation Webpage not found.');
        }
        $invitationwebpage->status = ($invitationwebpage->status === 'Active') ? 'Inactive' : 'Active';
        $invitationwebpage->save();

        return redirect('admin/invitation/webpage')->with('success', 'Invitation Webpage status successfully updated.');
    }

}
