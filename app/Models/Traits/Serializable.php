<?php

namespace App\Models\Traits;

use ErrorException;
use ReflectionClass;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * serializable trait
 */
trait Serializable
{
    use Meta;

    public function toArray()
    {
        $relations = [];
        $relationships = $this->getRelationships();
        foreach ($relationships as $relation_key => $relationship) {
            $class = $relationship['model'];
            $relations[$relation_key] = [
                'meta' => $class::metaForIndex(),
                'data' => $relationship['data']
            ];
        }
        return array_merge($this->attributesToArray(), $relations);
    }

    protected function getRelationships()
    {
        $model = new static;
        foreach ($this->getRelations() as $key => $value) {
            $method = (new ReflectionClass($model))->getMethod($key);
            $return = $method->invoke($model);
            yield $method->getName() => [
                'type' => (new ReflectionClass($return))->getShortName(),
                'model' => (new ReflectionClass($return->getRelated()))->getName(),
                'data' => $value
            ];
        }
    }
}
