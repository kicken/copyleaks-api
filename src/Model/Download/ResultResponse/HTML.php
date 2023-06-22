<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class HTML implements JsonConstructable {
    public string $value;
    public Comparison $comparison;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->value = $json->value;
        $self->comparison = Comparison::createFromJsonObject($json->comparison);

        return $self;
    }
}
