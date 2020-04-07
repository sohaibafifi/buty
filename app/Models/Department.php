<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Interfaces\VisibleInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model implements VisibleInterface
{
    use Traits\Serializable;
    use Traits\VisibleScopeTrait;
    use SoftDeletes;

    protected $serveOnApi = true;

    protected $fillable = [
        'name', 'scodocId', 'scodoc_url'
    ];
    protected $hidden = [
        'scodoc_password', 'scodoc_user',
    ];

    protected $load = [
        'formations'
    ];


    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function visible(Builder $builder)
    {
        return $builder;
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
