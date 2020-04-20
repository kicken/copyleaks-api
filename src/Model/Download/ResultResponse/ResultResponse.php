<?php


namespace Kicken\Copyleaks\Model\Download\ResultResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class ResultResponse implements JsonConstructable {
    /** @var Statistics */
    public $statistics;
    /** @var Text */
    public $text;
    /** @var HTML */
    public $html;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->statistics = Statistics::createFromJsonObject($json->statistics);
        $self->text = Text::createFromJsonObject($json->text);
        if ($json->html && get_object_vars($json->html)){
            $self->html = HTML::createFromJsonObject($json->html);
        }

        return $self;
    }
}
