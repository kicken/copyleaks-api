<?php


namespace Kicken\Copyleaks\Model\Webhook\Export\Helper;


use Kicken\Copyleaks\Model\JsonConstructable;

class CrawledVersionContent implements JsonConstructable {
    public string $value;
    public Excludes $exclude;
    public ?Pages $pages;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->value = $json->value;
        $self->exclude = Excludes::createFromJsonObject($json->exclude);
        $self->pages = isset($json->pages) ? Pages::createFromJsonObject($json->pages) : null;

        return $self;
    }
}
