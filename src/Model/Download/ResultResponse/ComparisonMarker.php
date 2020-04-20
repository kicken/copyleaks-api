<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class ComparisonMarker implements JsonConstructable {
    /** @var ComparisonMarkerData */
    public $chars;
    /** @var ComparisonMarkerData */
    public $words;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->chars = ComparisonMarkerData::createFromJsonObject($json->chars);
        $self->words = ComparisonMarkerData::createFromJsonObject($json->words);

        return $self;
    }
}
