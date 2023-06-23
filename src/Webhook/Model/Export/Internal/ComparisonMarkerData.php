<?php


namespace Kicken\Copyleaks\Webhook\Model\Export\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

class ComparisonMarkerData implements JsonConstructable {
    /** @var int[] */
    public array $starts;
    /** @var int[] */
    public array $lengths;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->starts = $json->starts;
        $self->lengths = $json->lengths;

        return $self;
    }
}
