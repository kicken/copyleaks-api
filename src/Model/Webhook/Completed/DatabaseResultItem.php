<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


class DatabaseResultItem extends ResultItem {
    public $scanId;

    public static function createFromJsonObject(\stdClass $json){
        $self = parent::createFromJsonObject($json);
        $self->scanId = $json->scanId;

        return $self;
    }
}
