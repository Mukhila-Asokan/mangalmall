<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccasionDataField extends Model
{
    use HasFactory;
    protected $table = 'occasiondatafields';

    public function occasion()
    {
        return $this->belongsTo(OccasionType::class,'occasion_id','id');
    }
}
