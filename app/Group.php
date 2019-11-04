<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'scodocId','cal'
    ];
    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
