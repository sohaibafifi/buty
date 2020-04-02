<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'name', 'scodocId',
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
