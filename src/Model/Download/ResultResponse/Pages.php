<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Pages implements JsonConstructable {
    /** @var int[] */
    public $startPosition;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->startPosition = $json->startPosition;

        return $self;
    }
}
