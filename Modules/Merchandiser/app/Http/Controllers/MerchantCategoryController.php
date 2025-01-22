<?php

namespace Modules\Merchandiser\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Merchandiser\Models\MerchantCategory;
use Session;

class MerchantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Merchandiser Model";
        $merchandisermodel = MerchantCategory::where('delete_status','0')->paginate(10);
        return view('merchandiser::merchandisermodel.index', compact('pagetitle','pageroot','merchandisermodel','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Merchandiser Model";
        return view('merchandiser::merchandisermodel.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_icon' => 'required',
            'category_image' => 'required',

         ]);
         $merchant = new MerchantCategory;
         $merchant->category_name = $request->category_name;
         $merchant->category_icon = $request->category_icon;
         $merchant->category_image = $request->category_image;
         $merchant->status = 'Active';
         $merchant->delete_status = 0;
         $merchant->save(); 

         return redirect('admin/merchandiser/merchandisermodel')->with('success', 'Merchandiser successfully created');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('merchandiser::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('merchandiser::edit');
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
        //
    }
}
