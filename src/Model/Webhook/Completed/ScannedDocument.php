<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


use Kicken\Copyleaks\Model\JsonConstructable;

class ScannedDocument implements JsonConstructable {
    public int $scanId;
    public int $totalWords;
    public int $totalExcluded;
    public int $credits;
    public \DateTimeInterface $creationTime;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new self;
        $self->scanId = $json->scanId;
        $self->totalWords = $json->totalWords;
        $self->totalExcluded = $json->totalExcluded;
        $self->credits = $json->credits;
        $self->creationTime = new \DateTime($json->creationTime);

        return $self;
    }
}
