<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Blog\Database\Factories\BlogTagFactory;

class BlogTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'blogtags';
    // protected static function newFactory(): BlogTagFactory
    // {
    //     // return BlogTagFactory::new();
    // }
}
