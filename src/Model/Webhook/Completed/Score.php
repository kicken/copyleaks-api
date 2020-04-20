<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


use Kicken\Copyleaks\Model\JsonConstructable;

class Score implements JsonConstructable {
    /** @var int */
    public $identicalWords;
    /** @var int */
    public $minorChangedWords;
    /** @var int */
    public $relatedMeaningWords;
    /** @var int */
    public $aggregatedScore;

    public static function createFromJsonObject(\stdClass $json){
        $self = new self;
        $self->identicalWords = $json->identicalWords;
        $self->minorChangedWords = $json->minorChangedWords;
        $self->relatedMeaningWords = $json->relatedMeaningWords;
        $self->aggregatedScore = $json->aggregatedScore;

        return $self;
    }
}
