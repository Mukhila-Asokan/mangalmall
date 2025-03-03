<?php

namespace Modules\Subcription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Subcription\Database\Factories\SubscriberPermissionMenuFactory;

class SubscriberPermissionMenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "subscriber_permissions";

    // protected static function newFactory(): SubscriberPermissionMenuFactory
    // {
    //     // return SubscriberPermissionMenuFactory::new();
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
