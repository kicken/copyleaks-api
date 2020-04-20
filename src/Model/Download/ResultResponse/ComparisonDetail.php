<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class ComparisonDetail implements JsonConstructable {
    /** @var int */
    public $groupId;
    /** @var ComparisonMarker */
    public $source;
    /** @var ComparisonMarker */
    public $suspected;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->groupId = $json->groupId ?? [];
        $self->source = ComparisonMarker::createFromJsonObject($json->source);
        $self->suspected = ComparisonMarker::createFromJsonObject($json->suspected);

        return $self;
    }
}
