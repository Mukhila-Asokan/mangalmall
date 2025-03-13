<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\UserBlog;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Models\BlogTag;

class UserBlogController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        $blogs = UserBlog::all();
        return view('blog.index',compact('blogs','categories','tags'));
        
    }
    public function show($id)
    {
        return view('blog.show');
    }
    public function create()
    {
        return view('blog.create');
    }
    public function store(Request $request)
    {
        return redirect()->route('blog.index');
    }
    public function edit($id)
    {
        return view('blog.edit');
    }
    public function update(Request $request, $id)
    {
        return redirect()->route('blog.index');
    }
    public function destroy($id)
    {
        return redirect()->route('blog.index');
    }
}
