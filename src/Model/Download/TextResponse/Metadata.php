<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Metadata implements JsonConstructable {
    public int $words;
    public int $excluded;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->words = $json->words;
        $self->excluded = $json->excluded;

        return $self;
    }
}
