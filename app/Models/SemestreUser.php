<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SemestreUser extends Pivot
{
    //protected $casts = ['bulletin' => 'array'];

    public function toArray()
    {
        return array_merge(
            $this->attributesToArray(),
            $this->relationsToArray(),
            ['bulletin' => json_decode(json_decode($this->bulletin))]
        );
    }
}
