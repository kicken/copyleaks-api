<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class TextResponse implements JsonConstructable {
    /** @var Metadata */
    public $metadata;
    /** @var HTML */
    public $html;
    /** @var Text */
    public $text;

    public static function createFromJsonObject(\stdClass $json){
        $self = new static();
        $self->metadata = Metadata::createFromJsonObject($json->metadata);
        $self->text = Text::createFromJsonObject($json->text);

        if (isset($json->html) && get_object_vars($json->html)){
            $self->html = HTML::createFromJsonObject($json->html);
        }

        return $self;
    }
}
