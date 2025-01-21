<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserOccasion extends Model
{
    /** @use HasFactory<\Database\Factories\UserOccasionFactory> */
    use HasFactory;

    public function Occasionname()
    {
        return $this->hasOne(OccasionType::class,'id','occasiontypeid');
    }
}
