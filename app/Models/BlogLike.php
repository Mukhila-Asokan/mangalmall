<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Blog;

class BlogLike extends Model
{
    use HasFactory;
    protected $table = 'blog_likes';

    protected $fillable = ['user_id', 'user_blog_id'];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
