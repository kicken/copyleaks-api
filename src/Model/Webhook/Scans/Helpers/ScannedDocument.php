<?php


namespace Kicken\Copyleaks\Model\Webhook\Scans\Helpers;


use Kicken\Copyleaks\Model\JsonConstructable;

class ScannedDocument implements JsonConstructable {
    public string $scanId;
    public int $totalWords;
    public int $totalExcluded;
    public int $credits;
    public \DateTimeInterface $creationTime;
    public ?ResultItemMetadata $metadata;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new self;
        $self->scanId = $json->scanId;
        $self->totalWords = $json->totalWords;
        $self->totalExcluded = $json->totalExcluded;
        $self->credits = $json->credits;
        $self->creationTime = new \DateTime($json->creationTime);
        $self->metadata = ResultItemMetadata::createFromJsonObject($json->metadata);

        return $self;
    }
}
