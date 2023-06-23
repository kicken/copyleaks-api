<?php


namespace Kicken\Copyleaks\Webhook\Model\Export\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

class Statistics implements JsonConstructable {
    public int $identical;
    public int $minorChanges;
    public int $relatedMeaning;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->identical = $json->identical;
        $self->minorChanges = $json->minorChanges;
        $self->relatedMeaning = $json->relatedMeaning;

        return $self;
    }
}
