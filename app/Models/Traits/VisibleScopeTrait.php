<?php

namespace App\Models\Traits;

use App\Models\Scopes\VisibleScope;
use Illuminate\Database\Eloquent\Builder;

trait VisibleScopeTrait
{
    public static function bootVisibleScopeTrait()
    {
        static::addGlobalScope(new VisibleScope);
    }
}
