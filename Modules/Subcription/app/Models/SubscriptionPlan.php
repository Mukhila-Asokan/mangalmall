<?php

namespace Modules\Subcription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Subcription\Database\Factories\SubscriptionPlanFactory;

class SubscriptionPlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'subscribers_plans';
    // protected static function newFactory(): SubscriptionPlanFactory
    // {
    //     // return SubscriptionPlanFactory::new();
    // }
}
