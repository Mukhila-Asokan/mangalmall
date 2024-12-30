<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
 use Illuminate\Foundation\Auth\User as AuthenticatableTrait;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Notifications\Notifiable;


class AdminUser extends Model implements Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'admin_users';
    protected $table = 'admin_users';

      protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAuthIdentifierName()
{
    return 'id'; // Assuming 'id' is your primary key column
}

public function getAuthIdentifier()
{
    return $this->getKey(); 
}

public function getAuthPassword()
{
    return $this->password; 
}

public function getAuthPasswordName()
{
    return 'password'; // Assuming your password column is named 'password'
}

public function getRememberToken()
{
    return $this->remember_token; 
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
    $this->save();
}

public function getRememberTokenName()
{
    return 'remember_token'; 
}
}
