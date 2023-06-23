<?php


namespace Kicken\Copyleaks\Webhook\Model\Scans\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

class Score implements JsonConstructable {
    public int $identicalWords;
    public int $minorChangedWords;
    public int $relatedMeaningWords;
    public float $aggregatedScore;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new self;
        $self->identicalWords = $json->identicalWords ?? 0;
        $self->minorChangedWords = $json->minorChangedWords ?? 0;
        $self->relatedMeaningWords = $json->relatedMeaningWords ?? 0;
        $self->aggregatedScore = $json->aggregatedScore ?? 0;

        return $self;
    }
}
