<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * authorizable trait
 */
trait Authorizable
{
    public static function authorizable()
    {
        return !is_null(Gate::getPolicyFor(static::class));
    }

    public function authorizeTo($ability)
    {
        throw_unless($this->authorizedTo($ability), AuthorizationException::class);
    }


    public function authorizedTo($ability)
    {
        return static::authorizable() ? Gate::check($ability, $this) : true;
    }

    public function authorizeToViewAny()
    {
        if (!static::authorizable()) {
            return;
        }

        if (method_exists(Gate::getPolicyFor(static::class), 'viewAny')) {
            $this->authorizeTo('viewAny');
        }
    }

    public static function authorizedToViewAny()
    {
        if (!static::authorizable()) {
            return true;
        }

        return method_exists(Gate::getPolicyFor(static::class), 'viewAny')
            ? Gate::check('viewAny', static::class)
            : true;
    }


    public function authorizeToView()
    {
        return $this->authorizeTo('view') && $this->authorizeToViewAny();
    }


    public function authorizedToView()
    {
        return $this->authorizedTo('view') && $this->authorizedToViewAny();
    }

    public static function authorizeToCreate()
    {
        throw_unless(static::authorizedToCreate(), AuthorizationException::class);
    }

    public static function authorizedToCreate()
    {
        if (static::authorizable()) {
            return Gate::check('create', static::class);
        }

        return true;
    }

    public function authorizeToUpdate()
    {
        return $this->authorizeTo('update');
    }

    public function authorizedToUpdate()
    {
        return $this->authorizedTo('update');
    }

    public function authorizeToDelete()
    {
        return $this->authorizeTo('delete');
    }


    public function authorizedToDelete()
    {
        return $this->authorizedTo('delete');
    }

    public function authorizedToRestore()
    {
        return $this->authorizedTo('restore');
    }

    public function authorizedToForceDelete()
    {
        return $this->authorizedTo('forceDelete');
    }


    public function authorizedToAdd($model)
    {
        if (!static::authorizable()) {
            return true;
        }

        $method = 'add' . class_basename($model);

        return method_exists(Gate::getPolicyFor($this), $method)
            ? Gate::check($method, $this)
            : true;
    }

    public function authorizedToAttachAny($model)
    {
        if (!static::authorizable()) {
            return true;
        }

        $method = 'attachAny' . Str::singular(class_basename($model));

        return method_exists(Gate::getPolicyFor($this), $method)
            ? Gate::check($method, [$this])
            : true;
    }

    public function authorizedToAttach($model)
    {
        if (!static::authorizable()) {
            return true;
        }

        $method = 'attach' . Str::singular(class_basename($model));

        return method_exists(Gate::getPolicyFor($this), $method)
            ? Gate::check($method, [$this, $model])
            : true;
    }

    public function authorizedToDetach($model)
    {
        if (!static::authorizable()) {
            return true;
        }

        $method = 'detach' . Str::singular(class_basename($model));

        return method_exists(Gate::getPolicyFor($this), $method)
            ? Gate::check($method, [$this, $model])
            : true;
    }

    public static function softDeletes()
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses(static::class));
    }

    public function isSoftDeleted()
    {
        return static::softDeletes() &&
            !is_null($this->{$this->getDeletedAtColumn()});
    }
}
