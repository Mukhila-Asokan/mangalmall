<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWebPageData extends Model
{
    use HasFactory;
    protected $table = 'userwebpages_data';

    public function userwebpagedataname()
    {
        return $this->belongsTo('App\Models\OccasionDataField', 'datafield_id', 'id');
    }
}
