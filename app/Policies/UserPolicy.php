<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Subscriber;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;
    public function __construct()
    {
        
    }
    public function accessPaidMenus(User $user) {
        $subscriber = Subscriber::where('subscriber_id', $user->id)->where('status', 'Active')->first();
        if (!$subscriber) return false; // No active subscription

        return in_array($subscriber->subscriptionPlan->name, ['Gold', 'Silver']); 
    }

 /*  public function accessFreeMenus(User $user) {
        $subscriber = Subscriber::where('subscriber_id', $user->id)->where('status', 'Active')->first();
        if (!$subscriber) return false; // No active subscription

        return $subscriber->subscriptionPlan->name === 'Free';
    }*/

}
// Compare this snippet from Modules/Subcription/resources/views/subcriptionplan/index.blade.php:
