<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


class InternetResultItem extends ResultItem {
    public $url;

    public static function createFromJsonObject(\stdClass $json){
        $self = parent::createFromJsonObject($json);
        $self->url = $json->url;

        return $self;
    }
}
