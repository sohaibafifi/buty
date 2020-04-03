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
            $relation = $this->getRelation($relation_key);
            $seralized_relation = [];
            foreach ($relation as $key => $model) {
                if (is_callable($model->serialize))
                    $seralized_relation[$key] = $model->serialize();
                else
                    $seralized_relation[$key] = $model;
            }
            $relations[$relation_key] = [
                'meta' => $class::metaForIndex(),
                'data' => $seralized_relation
            ];
        }

        return array_merge($this->attributesToArray(), $relations);
    }

    public function getRelationships()
    {
        $model = new static;
        $relationships = [];
        foreach ($this->getRelations() as $key => $value) {
            $method = (new ReflectionClass($model))->getMethod($key);
            if (
                $method->class != get_class($model) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__
            ) {
                continue;
            }
            try {
                $return = $method->invoke($model);
                if ($return instanceof Relation) {
                    $relationships[$method->getName()] = [
                        'type' => (new ReflectionClass($return))->getShortName(),
                        'model' => (new ReflectionClass($return->getRelated()))->getName()
                    ];
                }
            } catch (ErrorException $e) {
            }
        }
        return $relationships;
    }
}
