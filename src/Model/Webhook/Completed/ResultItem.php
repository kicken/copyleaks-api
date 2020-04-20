<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


use Kicken\Copyleaks\Model\JsonConstructable;

abstract class ResultItem implements JsonConstructable {
    public $id;
    public $title;
    public $introduction;
    public $matchedWords;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->id = $json->id;
        $self->title = $json->title;
        $self->introduction = $json->introduction;
        $self->matchedWords = $json->matchedWords;

        return $self;
    }
}
