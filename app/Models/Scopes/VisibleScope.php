<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use  App\Models\Interfaces\VisibleInterface;

class VisibleScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if ($model instanceof VisibleInterface || is_callable($model->visible)) {
            return $model->visible($builder);
        }
        return $builder;
    }
}
