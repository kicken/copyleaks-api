<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class ComparisonDetail implements JsonConstructable {
    public int $groupId;
    public ComparisonMarker $source;
    public ComparisonMarker $suspected;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->groupId = $json->groupId ?? [];
        $self->source = ComparisonMarker::createFromJsonObject($json->source);
        $self->suspected = ComparisonMarker::createFromJsonObject($json->suspected);

        return $self;
    }
}
