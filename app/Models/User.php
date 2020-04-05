<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'firstname', 'lastname', 'role',
        'scodocId', 'nip', 'ine'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getNameAttribute()
    {
        return $this->firstname . ' ' . strtoupper($this->lastname);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function semestres()
    {
        return $this->belongsToMany(Semestre::class)->withPivot([
            'bulletin'
        ])->using(SemestreUser::class);
    }
}
