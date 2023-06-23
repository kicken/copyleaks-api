<?php

namespace Kicken\Copyleaks\Webhook\Model\Scans;

use Kicken\Copyleaks\Model\JsonConstructable;

class Indexed implements JsonConstructable {
    public int $status;
    public string $developerPayload;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        $obj->status = $json->status ?? 1;
        $obj->developerPayload = $json->developerPayload ?? '';

        return $obj;
    }
}
