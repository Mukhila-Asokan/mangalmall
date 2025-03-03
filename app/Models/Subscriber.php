<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SubscriptionPlan;

class Subscriber extends Model
{
    protected $table = 'subscriber_subscriptions';
    protected $fillable = ['subscriber_id', 'plan_id', 'status'];

    public function user() {
        return $this->belongsTo(User::class, 'subscriber_id');
    }


    public function subscriptionPlan() {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }
}

