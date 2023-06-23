<?php


namespace Kicken\Copyleaks\Webhook\Model\Export\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

class Comparison implements JsonConstructable {
    public ComparisonDetail $identical;
    public ComparisonDetail $minorChanges;
    public ComparisonDetail $relatedMeaning;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->identical = ComparisonDetail::createFromJsonObject($json->identical);
        $self->minorChanges = ComparisonDetail::createFromJsonObject($json->minorChanges);
        $self->relatedMeaning = ComparisonDetail::createFromJsonObject($json->relatedMeaning);

        return $self;
    }
}
