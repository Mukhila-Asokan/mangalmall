<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\Models\BlogCategory;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $pageroot = "Blog";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Blog Category";
        $blogCategories = BlogCategory::where('delete_status', '0')->paginate(10);
        return view('blog::blogcategory.index', compact('pagetitle', 'pageroot', 'blogCategories', 'username'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Blog";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Blog Category";
        return view('blog::blogcategory.create', compact('pagetitle', 'pageroot', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'categoryname' => 'required|unique:blog_category'
        ]);
       
        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {           
            $blogCategory = new BlogCategory();
            $blogCategory->categoryname = $request->categoryname;
            $blogCategory->status = 'Active';
            $blogCategory->delete_status = 0;
            $blogCategory->save();
            
            return redirect()->route('admin.blogcategory')->with('success', 'Blog Category added successfully.');
           
        } catch (\Exception $e) {     
            return redirect()->route('admin.blogcategory')->with('error', $e->getMessage());  
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
        $pagetitle = "Edit Blog Category";
        $category = BlogCategory::findOrFail($id);
        return view('blog::blogcategory.edit', compact('pagetitle', 'pageroot', 'username', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'categoryname' => 'required|unique:blog_category,categoryname,' . $id
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {           
            $blogCategory = BlogCategory::findOrFail($id);
            $blogCategory->categoryname = $request->categoryname;
            $blogCategory->status = $request->status ?? 'Active';
            $blogCategory->save();
            return redirect()->route('admin.blogcategory')->with('success', 'Blog Category updated successfully.');           
        } catch (\Exception $e) {     
            return redirect()->route('admin.blogcategory')->with('error', $e->getMessage());  
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $blogCategory = BlogCategory::find($id);
            $blogCategory->delete_status = 1;
            $blogCategory->save();
            return redirect()->route('admin.blogcategory')->with('success', 'Blog Category deleted successfully.'); 
        } catch (\Exception $e) {
            return redirect()->route('admin.blogcategory')->with('error', $e->getMessage());  
        }
    }
    public function updatestatus($id)
    {
        $blogCategory = BlogCategory::find($id);
        if (!$blogCategory) {
            return redirect()->route('admin.blogcategory')->with('error', 'Blog Category not found.');            
        }
        $blogCategory->status = ($blogCategory->status === 'Active') ? 'Inactive' : 'Active';
        $blogCategory->save();
        return redirect()->route('admin.blogcategory')->with('success', 'Blog Category status successfully updated.');     
    }
}
