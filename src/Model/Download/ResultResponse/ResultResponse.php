<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class ResultResponse implements JsonConstructable {
    public Statistics $statistics;
    public Text $text;
    public HTML $html;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->statistics = Statistics::createFromJsonObject($json->statistics);
        $self->text = Text::createFromJsonObject($json->text);
        if ($json->html && get_object_vars($json->html)){
            $self->html = HTML::createFromJsonObject($json->html);
        }

        return $self;
    }
}
