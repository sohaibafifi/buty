<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Traits\Serializable;
    protected $fillable = [
        'name', 'scodocId', 'scodoc_url'
    ];
    protected $hidden = [
        'scodoc_password', 'scodoc_user',
    ];

    protected $with = [
        'formations',
    ];

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}
