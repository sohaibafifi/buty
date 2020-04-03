<?php

namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface VisibleInterface
{
    public function visible(Builder $builder);
}
