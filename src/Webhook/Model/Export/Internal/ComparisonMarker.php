<?php


namespace Kicken\Copyleaks\Webhook\Model\Export\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

class ComparisonMarker implements JsonConstructable {
    public ComparisonMarkerData $chars;
    public ComparisonMarkerData $words;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->chars = ComparisonMarkerData::createFromJsonObject($json->chars);
        $self->words = ComparisonMarkerData::createFromJsonObject($json->words);

        return $self;
    }
}
