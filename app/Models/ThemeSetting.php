<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $table = 'themesettings';
    protected $fillable = [
        'data_key',
        'data_value',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'theme_value', 'id');
    }
    public function themeSetting()
    {
        return $this->belongsTo(User::class, 'theme_name', 'id');
    }
}
