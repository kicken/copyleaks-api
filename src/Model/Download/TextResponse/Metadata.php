<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Metadata implements JsonConstructable {
    /** @var int */
    public $words;
    /** @var int */
    public $excluded;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->words = $json->words;
        $self->excluded = $json->excluded;

        return $self;
    }
}
