<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueCampaignsFactory;

class VenueCampaigns extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */


    protected $table = "venue_campaigns";

    protected $fillable = [];

    // protected static function newFactory(): VenueCampaignsFactory
    // {
    //     // return VenueCampaignsFactory::new();
    // }
}
