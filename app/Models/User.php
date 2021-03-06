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
        'scodocId', 'nip', 'ine', 'cal'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    protected $appends = [
        'name'
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
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    public function semestres()
    {
        return $this->belongsToMany(Semestre::class)->withPivot([
            'bulletin'
        ])->using(SemestreUser::class)->withTimestamps();
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class)->withTimestamps();
    }
}
