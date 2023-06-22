<?php


namespace Kicken\Copyleaks\Model\Download\TextResponse;


use Kicken\Copyleaks\Model\JsonConstructable;

class Text implements JsonConstructable {
    public string $value;
    public Excludes $exclude;
    public Pages $pages;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->value = $json->value;
        $self->exclude = Excludes::createFromJsonObject($json->exclude);
        $self->pages = Pages::createFromJsonObject($json->pages);

        return $self;
    }
}
