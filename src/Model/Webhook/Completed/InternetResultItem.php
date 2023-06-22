<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


class InternetResultItem extends ResultItem {
    public string $url;

    public static function createFromJsonObject(\stdClass $json) : self{
        /** @var InternetResultItem $self */
        $self = parent::createFromJsonObject($json);
        $self->url = $json->url;

        return $self;
    }
}
