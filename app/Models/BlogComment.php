<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class BlogComment extends Model
{
    use HasFactory;
    protected $table = 'blogcomments';
    protected $fillable = [
        'blog_id',
        'user_id',
        'content',
        'reply_id',
        'blogcommentsstatus',
        'status',
        'delete_status'
    ];

    // Relationship: Parent Comment
    public function parent()
    {
        return $this->belongsTo(self::class, 'reply_id');
    }

    // Relationship: Replies
    public function replies()
    {
        return $this->hasMany(self::class, 'reply_id');
    }

    // Relationship: Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    // Relationship: User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
