<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\CardCampaignFactory;

class CardCampaign extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): CardCampaignFactory
    // {
    //     // return CardCampaignFactory::new();
    // }
}
