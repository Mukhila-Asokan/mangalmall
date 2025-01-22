<?php

namespace Modules\Merchandiser\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Merchandiser\Models\MerchandiserCategory;
use Session;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class MerchandiserCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Merchandiser Category";
        $merchandisermodel = MerchandiserCategory::where('delete_status','0')->paginate(10);

        return view('merchandiser::category.index', compact('pagetitle','pageroot','merchandisermodel','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Merchandiser Category";
        return view('merchandiser::category.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Initialize variables for storing file paths
        $categoryImagePath = null;
        $categoryIconPath = null;

        // Handle category_image upload
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $imageName = $originalName . '_' . uniqid() . '.' . $extension;
            $folderName = 'category_image/';

            // Upload to S3
            Storage::disk('s3')->put($folderName . $imageName, file_get_contents($image), ['visibility' => 'public']);
            
            $imageUrl = Storage::disk('s3')->url($folderName . $imageName);
            //$categoryImagePath = env('AWS_CLOUD_FRONT_URL') . '/' . ltrim($imageUrl, '/');
            $categoryImagePath = $imageUrl;
        }

        // Handle category_icon upload
        if ($request->hasFile('category_icon')) {
            $icon = $request->file('category_icon');
            $originalName = pathinfo($icon->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $icon->getClientOriginalExtension();
            $iconName = $originalName . '_' . uniqid() . '.' . $extension;
            $folderIcon = 'category_icon/';

            // Upload to S3
            Storage::disk('s3')->put($folderIcon . $iconName, file_get_contents($icon), ['visibility' => 'public']);
            
            $iconUrl = Storage::disk('s3')->url($folderIcon . $iconName);
            //$categoryIconPath = env('AWS_CLOUD_FRONT_URL') . '/' . ltrim($iconUrl, '/');
            $categoryIconPath = $iconUrl;
        }
        //dd($categoryIconPath);exit();
        // Save data in the database
        $merchant = new MerchandiserCategory;
        $merchant->category_name = $request->category_name;
        $merchant->category_image = $categoryImagePath;
        $merchant->category_icon = $categoryIconPath;
        $merchant->status = 'Active';
        $merchant->delete_status = 0;
        $merchant->save();

        return redirect()->route('merchandisercategory')->with('success', 'Merchandiser Category successfully created');
    }

    protected function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $size = $bytes;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return number_format($size, 1) . ' ' . $units[$unit];
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('merchandiser::category.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Merchandiser Category";
        $merchant = MerchandiserCategory::findOrFail($id);
        return view('merchandiser::category.edit', compact('merchant','pagetitle','pageroot','username'));
    }

    /**
     * Update the specified resource in storage.
     */
    /* public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
            'category_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Icon is optional during update
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional during update
        ]);

        $merchant = MerchandiserCategory::findOrFail($id); // Find the category by ID

        // Update the category name
        $merchant->category_name = $request->category_name;

        // Handle category icon upload (if provided)
        if ($request->hasFile('category_icon')) {
            // Ensure the directory for category icons exists
            if (!Storage::exists('public/uploads/category_icons')) {
                Storage::makeDirectory('public/uploads/category_icons', 0755, true); // Create with permissions
            }

            // Handle the new category icon upload
            $icon = $request->file('category_icon');
            $iconName = time() . '_icon_' . $icon->getClientOriginalName(); // Create a unique name
            $iconPath = $icon->storeAs('uploads/category_icons', $iconName, 'public'); // Save to 'storage/app/public/uploads/category_icons'
            $merchant->category_icon = $iconPath; // Update the path in the database
        }

        // Handle category image upload (if provided)
        if ($request->hasFile('category_image')) {
            // Ensure the directory for category images exists
            if (!Storage::exists('public/uploads/category_images')) {
                Storage::makeDirectory('public/uploads/category_images', 0755, true); // Create with permissions
            }

            // Handle the new category image upload
            $image = $request->file('category_image');
            $imageName = time() . '_image_' . $image->getClientOriginalName(); // Create a unique name
            $imagePath = $image->storeAs('uploads/category_images', $imageName, 'public'); // Save to 'storage/app/public/uploads/category_images'
            $merchant->category_image = $imagePath; // Update the path in the database
        }

        // Save the updated data
        $merchant->status = 'Active'; // Optionally, you can keep the status as 'Active' or update it as needed
        $merchant->delete_status = 0;
        $merchant->save();

        return redirect('admin/merchandisercategory')->with('success', 'Merchandiser Category successfully updated');
    } */

    public function update(Request $request, $id)
    {
        //dd($request);exit();
        $request->validate([
            'category_name' => 'required',
            'category_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the existing record
        $merchant = MerchandiserCategory::findOrFail($id);

        // Initialize variables for storing file paths
        $categoryImagePath = $merchant->category_image;
        $categoryIconPath = $merchant->category_icon;

        // Handle category_image update
        if ($request->category_image) {
            if ($merchant->category_image) {
                $oldImagePath = parse_url($merchant->category_image, PHP_URL_PATH);
                Storage::disk('s3')->delete(ltrim($oldImagePath, '/'));
            }

            $image = $request->file('category_image');
            $imageName = $image->getClientOriginalName();
            $folderName = 'category_image/';
            Storage::disk('s3')->put($folderName . $imageName, file_get_contents($image), ['visibility' => 'public']);
            $categoryImagePath = Storage::disk('s3')->url($folderName . $imageName);
        }

        // Handle category_icon update
        if ($request->category_icon) {
            if ($merchant->category_icon) {
                $oldIconPath = parse_url($merchant->category_icon, PHP_URL_PATH);
                Storage::disk('s3')->delete(ltrim($oldIconPath, '/'));
            }

            $icon = $request->file('category_icon');
            $iconName = $icon->getClientOriginalName();
            $folderIcon = 'category_icon/';
            Storage::disk('s3')->put($folderIcon . $iconName, file_get_contents($icon), ['visibility' => 'public']);
            $categoryIconPath = Storage::disk('s3')->url($folderIcon . $iconName);
        }

        // Update the database
        $merchant->category_name = $request->category_name;
        $merchant->category_image = $categoryImagePath;
        $merchant->category_icon = $categoryIconPath;
        $merchant->status = 'Active';
        $merchant->delete_status = 0;
        $merchant->save();

        return redirect()->route('merchandisercategory')->with('success', 'Merchandiser Category successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        MerchandiserCategory::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect()->route('merchandisercategory')->with('success', 'Merchandiser Category successfully deleted');
    }

    public function updatestatus($id) {    
        $merchant = MerchandiserCategory::where('id', '=', $id)->select('status')->first();
        $status = $merchant->status;
        $merchantstatus = "Active";
        if($status == "Active") {
            $merchantstatus = "Inactive";
        }
        MerchandiserCategory::where('id', '=', $id)->update(['status' => $merchantstatus]);
        return redirect()->route('merchandisercategory')->with('success', 'Occasion Type status successfully updated');
    }
}
