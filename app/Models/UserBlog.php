<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Models\BlogTag;
use Modules\Blog\Models\BlogCategory;

class UserBlog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['title','blogs','category','tags','status'];
   
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function category()
    {
        return $this->belongsTo(BlogCategory::class,'category_id','id');
    }
    public function tags()
    {
        return $this->belongsTo('Modules\Blog\Models\BlogTag');
    }
}
