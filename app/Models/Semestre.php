<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semestre extends Model
{
    use Traits\Serializable;
    use Traits\VisibleScopeTrait;
    use SoftDeletes;

    protected $serveOnApi = true;

    protected $fillable = [
        'name', 'scodocId',
    ];

    protected $load = [
        'groups', 'users',
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
        return $this->belongsToMany(User::class);
    }
}
