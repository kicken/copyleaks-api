<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Text implements JsonConstructable {
    /** @var string */
    public $value;
    /** @var Pages */
    public $pages;
    /** @var Comparison */
    public $comparison;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->value = $json->value;
        $self->pages = Pages::createFromJsonObject($json->pages);
        $self->comparison = Comparison::createFromJsonObject($json->comparison);

        return $self;
    }
}
