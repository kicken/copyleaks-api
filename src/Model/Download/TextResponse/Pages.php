<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Pages implements JsonConstructable {
    /** @var int[] */
    public array $startPosition;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->startPosition = $json->startPosition;

        return $self;
    }
}
