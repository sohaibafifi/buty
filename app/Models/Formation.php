<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use Traits\Serializable;

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
