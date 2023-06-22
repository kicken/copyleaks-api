<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


use Kicken\Copyleaks\Model\JsonConstructable;

abstract class ResultItem implements JsonConstructable {
    public string $id;
    public string $title;
    public string $introduction;
    public int $matchedWords;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->id = $json->id;
        $self->title = $json->title;
        $self->introduction = $json->introduction;
        $self->matchedWords = $json->matchedWords;

        return $self;
    }
}
