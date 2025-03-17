<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\UserBlog;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Models\BlogTag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserBlogController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $blogcount = UserBlog::where('delete_status','0')->where('user_id',$userid)->count();
        $viewcount = UserBlog::where('user_id', $userid)->sum('views');  // Count views
        $likescount =   UserBlog::where('user_id', $userid)->sum('likes');
        $dislikescount =   UserBlog::where('user_id', $userid)->sum('dislikes');
        $commentscount =  UserBlog::where('user_id', $userid)->sum('comments');
        $blogs = UserBlog::where('delete_status','0')->where('user_id',$userid)->paginate(12);
        $categories = BlogCategory::where('delete_status','0')->get();
        $tags = BlogTag::where('delete_status','0')->get();
        return view('blog.index',compact('blogs','categories','tags','blogcount','viewcount','likescount','dislikescount','commentscount'));
        
    }
    public function show($id)
    {       
        $userblog = UserBlog::where('id',$id)->first(); 

        $categories = BlogCategory::withCount('blogs') 
        ->where('delete_status', '0')          
        ->inRandomOrder()                      
        ->limit(6)                             
        ->get();

        $tags = BlogTag::where('delete_status','0')->inRandomOrder()   // Randomize order
        ->limit(6)          // Limit to 6 records
        ->get();;       
        $userblog->views = $userblog->views + 1;
        $userblog->save();
        $user_id = Auth::user()->id;
        $recentpost = UserBlog::where('delete_status','0')->where('status','Active')->where('blogstatus','published')   
                ->where('user_id',$userblog->user_id)->orderBy('created_at','desc')->limit(5)->get();
        return view('blog.show',compact('userblog','categories','tags','recentpost','user_id'));
    }
    public function create()
    {
        $categories = BlogCategory::where('delete_status','0')->get();
        $tags = BlogTag::where('delete_status','0')->get();
        return view('blog.create',compact('categories','tags'));
    }
    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'slug' => 'required|unique:blogs,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
            'tags' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            if ($request->hasFile('image')) {
               
                $filename = time() . '-' .  $request->file('image')->getClientOriginalName();
                $path =  $request->file('image')->storeAs('blogimages', $filename, 'public_uploads');

            }

            $tagsArray = collect(json_decode($request->tags, true))->pluck('value')->toArray();
            $tagsString = implode(',', $tagsArray); 
            $userBlog = new UserBlog();
            $userBlog->slug = $request->slug;
            $userBlog->image = $path ?? '';
            $userBlog->user_id = Auth::user()->id;
            $userBlog->category_id = $request->category;
            $userBlog->tags = $tagsString;
            $userBlog->blog_url = Str::slug($request->title);
            $userBlog->title = $request->title;
            $userBlog->content = $request->content;
            $userBlog->seo_title = $request->title;
            $userBlog->blogstatus = $request->blogstatus;
            $userBlog->seo_description =  Str::limit($request->seo_description, 200);
            $userBlog->seo_keywords = $tagsString;
            $userBlog->status = 'Active';
            $userBlog->delete_status = 0;

            $userBlog->save();

            return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('blog.index');
    }
    public function edit($id)
    {
        $categories = BlogCategory::where('delete_status','0')->get();
        $tags = BlogTag::where('delete_status','0')->get();
        $blog = UserBlog::findOrFail($id);
        return view('blog.edit', compact('categories', 'tags', 'blog'));
    }
    public function update(Request $request, $id)
    {
        return redirect()->route('blog.index');
    }
    public function destroy($id)
    {
        try {
            $blog = UserBlog::findOrFail($id);
            $blog->delete_status = 1;
            $blog->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('blog.index');
    }
    public function search(Request $request)
    {
        return view('blog.search');
    }
    public function searchResult(Request $request)
    {
        return view('blog.searchResult');
    }
    public function checkSlug()
    {
        return response()->json(['status' => 'success']);
    }
}
