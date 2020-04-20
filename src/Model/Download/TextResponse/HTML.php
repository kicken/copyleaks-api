<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class HTML implements JsonConstructable {
    /** @var string */
    public $value;
    /** @var Excludes */
    public $exclude;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->value = $json->value;
        $self->exclude = Excludes::createFromJsonObject($json->exclude);

        return $self;
    }
}
