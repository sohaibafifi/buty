<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SemestreUser extends Pivot
{
    protected $casts = ['bulletin' => 'array'];
}
