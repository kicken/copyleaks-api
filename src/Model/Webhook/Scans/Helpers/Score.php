<?php


namespace Kicken\Copyleaks\Model\Webhook\Scans\Helpers;


use Kicken\Copyleaks\Model\JsonConstructable;

class Score implements JsonConstructable {
    public int $identicalWords;
    public int $minorChangedWords;
    public int $relatedMeaningWords;
    public int $aggregatedScore;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new self;
        $self->identicalWords = $json->identicalWords;
        $self->minorChangedWords = $json->minorChangedWords;
        $self->relatedMeaningWords = $json->relatedMeaningWords;
        $self->aggregatedScore = $json->aggregatedScore;

        return $self;
    }
}
