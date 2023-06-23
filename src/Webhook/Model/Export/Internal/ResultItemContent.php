<?php


namespace Kicken\Copyleaks\Webhook\Model\Export\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

class ResultItemContent implements JsonConstructable {
    public string $value;
    public ?Pages $pages;
    public ?Comparison $comparison;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->value = $json->value ?? '';
        $self->pages = isset($json->pages) ? Pages::createFromJsonObject($json->pages) : null;
        $self->comparison = isset($json->comparison) ? Comparison::createFromJsonObject($json->comparison) : null;

        return $self;
    }
}
