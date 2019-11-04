<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'scodocId', 'scodoc_password', 'scodoc_user',
    ];
    protected $hidden = [

    ];
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}
