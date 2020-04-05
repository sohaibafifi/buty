<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Interfaces\VisibleInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model
{
    use Traits\Serializable;
    use Traits\VisibleScopeTrait;
    use SoftDeletes;

    protected $fillable = [
        'name', 'scodocId',
    ];

    protected $with = [
        'semestres',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function semestres()
    {
        return $this->hasMany(Semestre::class);
    }
}
