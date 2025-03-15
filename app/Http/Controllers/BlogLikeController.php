<?php

namespace App\Http\Controllers;

use App\Models\UserBlog;
use App\Models\BlogLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogLikeController extends Controller
{
    public function toggleLike(Request $request, $id)
    {
       
     
        $blog = UserBlog::findOrFail($id);
       
        $userId = Auth::user()->id;
        

        // Check if the user already liked the blog
        $existingLike = BlogLike::where('user_blog_id', $blog->id)->where('user_id', $userId)->first();

        

        if ($existingLike) {
            // Unlike the post
            $existingLike->delete();
            UserBlog::where('id', $id)->decrement('likes');
            return response()->json(['success' => true, 'message' => 'Like removed successfully']);
        } else {
            // Like the post
      
      
            BlogLike::create([
                'user_id' => $userId,
                'user_blog_id' => $blog->id
            ]);
            
            UserBlog::where('id', $id)->increment('likes');

            return response()->json(['success' => true, 'message' => 'Liked successfully']);
        }
    }

    // Show total likes for a blog
    public function getLikes($id)
    {
        $blog =  UserBlog::where('id', $id)->first();
        $likeCount = $blog->likes;

        return response()->json(['likes' => $likeCount]);
    }
}
