<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invitation\Models\CardTemplate;
use Illuminate\Support\Facades\Validator;
use App\Models\OccasionType;
use Session;
use Intervention\Image\ImageManager;
use Intervention\Image\Imagick\Driver;

class CardTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Invitation Card Template";
        $occasiontypes = OccasionType::where('delete_status', '0')->get();
        

        $query = CardTemplate::query()->where('delete_status', '0');

        // Searching by name
        if ($request->filled('search')) {
            $query->where('templatename', 'like', '%' . $request->search . '%');
        }

        if ($request->has('occasion') && $request->occasion != '') {
            $query->where('occasionid', $request->occasion);
        }

        // Sorting by name (asc or desc)
        if ($request->filled('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('templatename', $request->sort);
        }

        $cardTemplates = $query->paginate(20);

        return view('invitation::cardtemplate.index',compact('pageroot','username','userid','pagetitle','cardTemplates','occasiontypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $occasiontypes = OccasionType::where('delete_status', '0')->get();
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Invitation Card Template";
        return view('invitation::cardtemplate.create',compact('pageroot','username','userid','pagetitle','occasiontypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    
        $validator = Validator::make($request->all(), [
            'templatename' => 'required',
            'templateurl' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',         
            'occasionid' => 'required',
        ]);
        

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }
       
       

        try {
            if (!$request->hasFile('templateurl')) {
                return back()->with('error', 'No file uploaded.');
            }
        
            $templateUrl = $request->file('templateurl');
        
            // Ensure directories exist
            if (!file_exists(public_path('cardtemplates'))) {
                mkdir(public_path('cardtemplates'), 0777, true);
            }
            if (!file_exists(public_path('images/cardtemplates'))) {
                mkdir(public_path('images/cardtemplates'), 0777, true);
            }
        
            // Move original file
            $templateUrlName = time() . '.' . $templateUrl->getClientOriginalExtension();
            $templateUrl->move(public_path('cardtemplates'), $templateUrlName);
        
            // Resize the image
            $templateImagePath = public_path('cardtemplates/' . $templateUrlName);
            
            $manager = new ImageManager(['driver' => extension_loaded('imagick') ? 'imagick' : 'gd']);
            $resizedImage = $manager->make($templateImagePath)
            ->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        

          
          
            $templateImageName = time() . '_resized.' . $templateUrl->getClientOriginalExtension();
            $resizedImage->save(public_path('images/cardtemplates/' . $templateImageName));
        
            // Store in database
            if ($request->occasionid == 'all') {
                $occasionTypes = OccasionType::where('delete_status', '0')->get();
                foreach ($occasionTypes as $occasionType) {
                    CardTemplate::create([
                        'templatename' => $request->templatename,
                        'templateurl' => 'cardtemplates/' . $templateUrlName,
                        'templateimage' => 'images/cardtemplates/' . $templateImageName,
                        'occasionid' => $occasionType->id,
                        'status' => 'Active',
                        'delete_status' => 0,
                    ]);
                }
            } else {
                CardTemplate::create([
                    'templatename' => $request->templatename,
                    'templateurl' => 'cardtemplates/' . $templateUrlName,
                    'templateimage' => 'images/cardtemplates/' . $templateImageName,
                    'occasionid' => $request->occasionid,
                    'status' => 'Active',
                    'delete_status' => 0,
                ]);
            }
          
            return redirect('admin/invitation/cardtemplate')->with('success', 'Card Template added successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading file: ' . $e->getMessage());
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
        $occasiontypes = OccasionType::where('delete_status', '0')->get();
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Invitation Card Template";
        $cardTemplate = CardTemplate::findOrFail($id);
        return view('invitation::cardtemplate.edit', compact('pageroot', 'username', 'userid', 'pagetitle', 'occasiontypes', 'cardTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'templatename' => 'required',
            'templateurl' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',         
            'occasionid' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $cardTemplate = CardTemplate::findOrFail($id);

            if ($request->hasFile('templateurl')) {
            $templateUrl = $request->file('templateurl');
            
            // Ensure directories exist
            if (!file_exists(public_path('cardtemplates'))) {
                mkdir(public_path('cardtemplates'), 0777, true);
            }
            if (!file_exists(public_path('images/cardtemplates'))) {
                mkdir(public_path('images/cardtemplates'), 0777, true);
            }

            // Move original file
            $templateUrlName = time() . '.' . $templateUrl->getClientOriginalExtension();
            $templateUrl->move(public_path('cardtemplates'), $templateUrlName);

            // Resize the image
            $templateImagePath = public_path('cardtemplates/' . $templateUrlName);
            
            $manager = new ImageManager(['driver' => extension_loaded('imagick') ? 'imagick' : 'gd']);
            $resizedImage = $manager->make($templateImagePath)
                ->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
                });

            $templateImageName = time() . '_resized.' . $templateUrl->getClientOriginalExtension();
            $resizedImage->save(public_path('images/cardtemplates/' . $templateImageName));

            $cardTemplate->templateurl = 'cardtemplates/' . $templateUrlName;
            $cardTemplate->templateimage = 'images/cardtemplates/' . $templateImageName;
            }

            $cardTemplate->templatename = $request->templatename;
            $cardTemplate->occasionid = $request->occasionid;
            $cardTemplate->status = 'Active';
            $cardTemplate->delete_status = 0;
            $cardTemplate->save();

            return redirect('admin/invitation/cardtemplate')->with('success', 'Card Template updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/cardtemplate')->with('error', 'Error updating file: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cardTemplate = CardTemplate::find($id);
            $cardTemplate->delete_status = 1;
            $cardTemplate->save();
            return redirect('admin/invitation/cardtemplate')->with('success', 'Card Template deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/cardtemplate')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $cardTemplate = CardTemplate::find($id);
        if (!$cardTemplate) {
            return redirect('admin/invitation/cardtemplate')->with('error', 'Card Template not found.');
        }
        $cardTemplate->status = ($cardTemplate->status === 'Active') ? 'Inactive' : 'Active';
        $cardTemplate->save();

        return redirect('admin/invitation/cardtemplate')->with('success', 'Card Template status successfully updated.');
    }

}
