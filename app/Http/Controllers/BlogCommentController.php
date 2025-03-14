<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogComment;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
     // Store New Comment or Reply
     public function store(Request $request)
     {
         $request->validate([
             'blog_id' => 'required|exists:blogs,id',
             'content' => 'required|string',
             'reply_id' => 'nullable|exists:blog_comments,id' // For replies
         ]);
 
         BlogComment::create([
             'blog_id' => $request->blog_id,
             'user_id' => Auth::id(), // Ensure the user is logged in
             'content' => $request->content,
             'reply_id' => $request->reply_id, // Null for parent comments
             'blogcommentsstatus' => 'pending',
             'status' => 'Active',
             'delete_status' => 0
         ]);
 
         return response()->json(['success' => true, 'message' => 'Comment submitted successfully!']);
     }
 
     // Fetch Comments with Replies (for AJAX rendering)
     public function getComments($blogId)
     {
         $comments = BlogComment::where('blog_id', $blogId)
             ->whereNull('reply_id') // Get only parent comments
             ->with('replies', 'user') // Load replies and user details
             ->get();
 
         return response()->json($comments);
     }
}
