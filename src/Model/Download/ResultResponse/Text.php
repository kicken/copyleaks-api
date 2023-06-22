<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Text implements JsonConstructable {
    public string $value;
    public Pages $pages;
    public Comparison $comparison;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->value = $json->value;
        $self->pages = Pages::createFromJsonObject($json->pages);
        $self->comparison = Comparison::createFromJsonObject($json->comparison);

        return $self;
    }
}
