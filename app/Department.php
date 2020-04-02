<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'scodocId',
    ];
    protected $hidden = [
        'scodoc_password', 'scodoc_user',
    ];
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}
