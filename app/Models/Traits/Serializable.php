<?php

namespace App\Models\Traits;

use ReflectionClass;

/**
 * serializable trait
 */
trait Serializable
{
    use Meta;

    protected function loads()
    {
        $model = new static;
        return isset($model->load) ? $model->load : [];
    }


    public static function servable()
    {
        $model = new static;
        return isset($model->serveOnApi) ? $model->serveOnApi : false;
    }

    public function toArray()
    {
        $relations = [];
        foreach ($this->load($this->loads())->getRelationships() as $key => $relationship) {
            $relations[$key] = [
                'meta' => $relationship['model']::metaForIndex(),
                'data' => $relationship['data']
            ];
        }
        return array_merge($this->attributesToArray(), $relations);
    }

    protected function getRelationships()
    {
        $model = new static;
        foreach ($this->getRelations() as $key => $value) {
            $return = (new ReflectionClass($model))->getMethod($key)->invoke($model);
            yield $key => [
                'type' => (new ReflectionClass($return))->getShortName(),
                'model' => (new ReflectionClass($return->getRelated()))->getName(),
                'data' => $value
            ];
        }
    }
}
