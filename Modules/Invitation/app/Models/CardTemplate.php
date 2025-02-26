<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\CardTemplateFactory;

class CardTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'templatename',
        'templateurl',
        'templateimage',
        'occasionid',
        'status',
        'delete_status',       
    ];

    protected $table = 'cardtemplate';

 

    public function occasionType()
    {
        return $this->belongsTo('App\Models\OccasionType', 'occasionid');
    }
}
