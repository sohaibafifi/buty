<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

/**
 * meta trait
 */
trait Meta
{
    use Authorizable;

    public function initializeMeta()
    {
        $this->append('meta');
    }

    public function getMetaAttribute()
    {
        return $this->metaForDetail();
    }


    protected static function meta()
    {
        return [
            'model' => static::class,
            'table' => Str::snake(Str::pluralStudly(class_basename(static::class))),
            'uriKey' => Str::snake(Str::pluralStudly(class_basename(static::class))),
        ];
    }

    public function metaForDetail()
    {
        return array_merge($this->meta(), [
            'links' => [
                'self' => route('resources.show', [
                    'resource' => $this->meta()['uriKey'],
                    'id' => $this->id
                ])
            ],
            'authorizedToView' => $this->authorizedToView(),
            'authorizedToUpdate' => $this->authorizedToUpdate(),
            'authorizedToDelete' => $this->authorizedToDelete(),
            'authorizedToRestore' => static::softDeletes() && $this->authorizedToRestore(),
            'authorizedToForceDelete' => static::softDeletes() && $this->authorizedToForceDelete(),
            'softDeletes' => static::softDeletes(),
            'softDeleted' => $this->isSoftDeleted(),
        ]);
    }


    public static function metaForIndex()
    {
        return array_merge(static::meta(), [
            'authorizedToViewAny' => static::authorizedToViewAny(),
            'authorizedToCreate' => static::authorizedToCreate(),
            'softDeletes' => static::softDeletes(),
        ]);
    }
}
