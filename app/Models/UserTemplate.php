<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{
    protected $table = 'usertemplate';

    protected $fillable = [
        'user_id',
        'campaign_id',
        'template_data', // Added to allow mass assignment
        'occasion_id',
        'template_name',
        'template_size',
        'status',
        'modifydate',
        'datetime',
        'thumb',
        'gradient_background',
        'template_custom_size'
    ];

    public function occasion()
    {
        return $this->belongsTo('App\Models\OccasionType', 'occasion_id');
    }
}
