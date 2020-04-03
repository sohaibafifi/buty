<?php

namespace App\Models;

use ErrorException;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Relations\Relation;

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
