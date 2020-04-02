<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $fillable = [
        'name', 'scodocId',
    ];
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot([
            'bulletin'
        ])->using(SemestreUser::class);;
    }
}