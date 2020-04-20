<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class HTML implements JsonConstructable {
    /** @var string */
    public $value;
    /** @var Comparison */
    public $comparison;

    public static function createFromJsonObject(\stdClass $jsonData){
        $self = new static();
        $self->value = $jsonData->value;
        $self->comparison = Comparison::createFromJsonObject($jsonData->comparison);

        return $self;
    }
}
