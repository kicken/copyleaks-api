<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Excludes implements JsonConstructable {
    /** @var int[] */
    public $starts;
    /** @var int[] */
    public $lengths;
    /** @var int[] */
    public $reasons;
    /** @var int[] */
    public $groupIds;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->starts = $json->starts;
        $self->lengths = $json->lengths;
        $self->reasons = $json->reasons;
        $self->groupIds = $json->groupIds ?? [];

        return $self;
    }
}
