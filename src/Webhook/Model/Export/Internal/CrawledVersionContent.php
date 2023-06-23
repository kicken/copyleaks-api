<?php


namespace Kicken\Copyleaks\Webhook\Model\Export\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

class CrawledVersionContent implements JsonConstructable {
    public string $value;
    public Excludes $exclude;
    public ?Pages $pages;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->value = $json->value ?? '';
        $self->exclude = Excludes::createFromJsonObject($json->exclude ?? new \stdClass());
        $self->pages = isset($json->pages) ? Pages::createFromJsonObject($json->pages) : null;

        return $self;
    }
}
