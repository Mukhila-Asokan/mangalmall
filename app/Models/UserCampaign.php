<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCampaign extends Model
{
    protected $table = 'usercampaings';
    protected $fillable = ['userid','occasion_id','validupto','theme_id','themename','custom_css','custom_js','template_html','status','delete_status'];
}
