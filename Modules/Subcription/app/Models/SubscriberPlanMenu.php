<?php

namespace Modules\Subcription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Subcription\Database\Factories\SubscriberPlanMenuFactory;

class SubscriberPlanMenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = "subscription_plan_modules";

    // protected static function newFactory(): SubscriberPlanMenuFactory
    // {
    //     // return SubscriberPlanMenuFactory::new();
    // }
    public function subscriberplan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscriber_id');
    }
    public function usermenu()
    {
        return $this->belongsTo(UserMenu::class, 'menu_id');
    }
}
