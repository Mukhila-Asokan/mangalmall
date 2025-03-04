<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $table = 'subscribers_plans';
    protected $fillable = ['name', 'price', 'duration', 'status'];
}
