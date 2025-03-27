<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserOccasion extends Model
{
    /** @use HasFactory<\Database\Factories\UserOccasionFactory> */
    use HasFactory;

    protected $guarded = [];

    public function Occasionname()
    {
        return $this->hasOne(OccasionType::class,'id','occasiontypeid');
    }

    public function occasionGallery(){
        return $this->hasMany(UserEventGallery::class, 'event_id');
    }

    public function occasionItinerary(){
        return $this->hasMany(EventItinerary::class, 'event_id');
    }

    public function occasionCollaborate(){
        return $this->hasMany(EventCollaborator::class, 'event_id');
    }
}
