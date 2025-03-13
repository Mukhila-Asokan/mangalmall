<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Validator;
Use Modules\Blog\Models\BlogTag;

class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Blog";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Blog Tag";
        $blogTags = BlogTag::where('delete_status', '0')->paginate(10);
        return view('blog::blogtags.index', compact('pagetitle', 'pageroot', 'blogTags', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Blog";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Blog Tag";
        return view('blog::blogtags.create', compact('pagetitle', 'pageroot', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tagname' => 'required|unique:blogtags'
        ]);
           
        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {           
            $blogTag = new BlogTag();
            $blogTag->tagname = $request->tagname;
            $blogTag->status = 'Active';
            $blogTag->delete_status = 0;
            $blogTag->save();
            
            return redirect()->route('admin.blogtag')->with('success', 'Blog Tag added successfully.');
           
        } catch (\Exception $e) {     
            return redirect()->route('admin.blogtag')->with('error', $e->getMessage());  
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Blog";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Edit Blog Tag";
        $blogtag  = BlogTag::findOrFail($id);
        return view('blog::blogtags.edit', compact('pagetitle', 'pageroot', 'username', 'blogtag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tagname' => 'required|unique:blogtags,tagname,' . $id
        ]);
           
        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {           
            $blogTag = BlogTag::findOrFail($id);
            $blogTag->tagname = $request->tagname;
            $blogTag->status = $request->status ?? 'Active';
            $blogTag->delete_status = $request->delete_status ?? 0;
            $blogTag->save();
            
            return redirect()->route('admin.blogtag')->with('success', 'Blog Tag updated successfully.');
           
        } catch (\Exception $e) {     
            return redirect()->route('admin.blogtag')->with('error', $e->getMessage());  
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $blogTag = BlogTag::find($id);
            $blogTag->delete_status = 1;
            $blogTag->save();
            return redirect()->route('admin.blogtag')->with('success', 'Blog Tag deleted successfully.'); 
        } catch (\Exception $e) {
            return redirect()->route('admin.blogtag')->with('error', $e->getMessage());  
        }
    }

    public function updatestatus($id)
    {
        $blogTag = BlogTag::find($id);
        if (!$blogTag) {
            return redirect()->route('admin.blogtag')->with('error', 'Blog Tag not found.');
        }
        $blogTag->status = ($blogTag->status === 'Active') ? 'Inactive' : 'Active';
        $blogTag->save();
        return redirect()->route('admin.blogtag')->with('success', 'Blog Tag status successfully updated.');
    }
}
