<?php

namespace Kicken\Copyleaks\Model;

class ModelSerializer {
    public function serialize(object $model) : string{
        return json_encode($this->serializeValue($model));
    }

    private function serializeValue($value){
        if (is_scalar($value)){
            return $value;
        } else if (is_array($value)){
            $value = array_map([$this, 'serializeValue'], $value);

            return array_filter($value, function($item){
                return $item !== null;
            });
        } else {
            $result = new \stdClass();
            $setProperties = false;
            if ($value instanceof SerializerExclusions){
                $excludedProperties = $value->getExcludedPropertyNames();
            } else {
                $excludedProperties = [];
            }

            foreach (get_object_vars($value) as $name => $value){
                if ($value === null || in_array($name, $excludedProperties)){
                    continue;
                } else {
                    $value = $this->serializeValue($value);
                    if ($value !== null){
                        $setProperties = true;
                        $result->$name = $value;
                    }
                }
            }

            return $setProperties ? $result : null;
        }
    }
}
