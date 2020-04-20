<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class ComparisonMarkerData implements JsonConstructable {
    /** @var int[] */
    public $starts;
    /** @var int[] */
    public $lengths;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->starts = $json->starts;
        $self->lengths = $json->lengths;

        return $self;
    }
}
