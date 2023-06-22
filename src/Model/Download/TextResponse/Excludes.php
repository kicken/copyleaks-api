<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Excludes implements JsonConstructable {
    /** @var int[] */
    public array $starts;
    /** @var int[] */
    public array $lengths;
    /** @var int[] */
    public array $reasons;
    /** @var int[] */
    public array $groupIds;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->starts = $json->starts;
        $self->lengths = $json->lengths;
        $self->reasons = $json->reasons;
        $self->groupIds = $json->groupIds ?? [];

        return $self;
    }
}
