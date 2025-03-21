<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBudget extends Model
{
    protected $table = 'userbudget';
    protected $fillable = ['user_id', 'occasion_id', 'planned_amount', 'status', 'created_at', 'updated_at'];

    public function Occasionname()
    {
        return $this->hasOne(OccasionType::class,'id','occasiontypeid');
    }
}
