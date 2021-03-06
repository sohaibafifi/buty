<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use Traits\Serializable;
    use Traits\VisibleScopeTrait;
    use SoftDeletes;

    protected $serveOnApi = true;

    protected $fillable = [
        'name', 'scodocId', 'cal'
    ];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
