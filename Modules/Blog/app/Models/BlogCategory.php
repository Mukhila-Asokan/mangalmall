<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\UserBlog;
// use Modules\Blog\Database\Factories\BlogCategoryFactory;

class BlogCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'blog_category';

    // protected static function newFactory(): BlogCategoryFactory
    // {
    //     // return BlogCategoryFactory::new();
    // }
    // Custom Attribute for Blog Count
    public function blogs()
    {
        return $this->hasMany(UserBlog::class, 'category_id');  // Correct FK reference
    }
}
