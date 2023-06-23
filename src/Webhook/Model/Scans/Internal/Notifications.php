<?php

namespace Kicken\Copyleaks\Webhook\Model\Scans\Internal;

use Kicken\Copyleaks\Model\JsonConstructable;

class Notifications implements JsonConstructable {
    /** @var Alert[] */
    public array $alerts;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        $obj->alerts = array_map(function(\stdClass $v){
            return Alert::createFromJsonObject($v);
        }, $json->alerts);

        return $obj;
    }
}
