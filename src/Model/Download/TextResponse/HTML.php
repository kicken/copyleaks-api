<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class HTML implements JsonConstructable {
    public string $value;
    public Excludes $exclude;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->value = $json->value;
        $self->exclude = Excludes::createFromJsonObject($json->exclude);

        return $self;
    }
}
