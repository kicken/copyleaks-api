<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


use Kicken\Copyleaks\Model\JsonConstructable;

class ScannedDocument implements JsonConstructable {
    /** @var int */
    public $scanId;
    /** @var int */
    public $totalWords;
    /** @var int */
    public $totalExcluded;
    /** @var int */
    public $credits;
    /** @var int */
    public $creationTime;

    public static function createFromJsonObject(\stdClass $json){
        $self = new self;
        $self->scanId = $json->scanId;
        $self->totalWords = $json->totalWords;
        $self->totalExcluded = $json->totalExcluded;
        $self->credits = $json->credits;
        $self->creationTime = new \DateTime($json->creationTime);

        return $self;
    }
}
