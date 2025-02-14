<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\InvitationBudgetFactory;

class InvitationBudget extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table ='invitationbudget';

    // protected static function newFactory(): InvitationBudgetFactory
    // {
    //     // return InvitationBudgetFactory::new();
    // }
}
