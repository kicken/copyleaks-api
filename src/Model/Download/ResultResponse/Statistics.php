<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Statistics implements JsonConstructable {
    /** @var int */
    public $identical;
    /** @var int */
    public $minorChanges;
    /** @var int */
    public $relatedMeaning;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->identical = $json->identical;
        $self->minorChanges = $json->minorChanges;
        $self->relatedMeaning = $json->relatedMeaning;

        return $self;
    }
}
