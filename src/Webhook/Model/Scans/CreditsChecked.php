<?php

namespace Kicken\Copyleaks\Webhook\Model\Scans;

use Kicken\Copyleaks\Model\JsonConstructable;

class CreditsChecked implements JsonConstructable {
    public int $status;
    public string $developerPayload;
    public int $credits;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        $obj->status = $json->status ?? 1;
        $obj->developerPayload = $json->developerPayload;
        $obj->credits = $json->credits;

        return $obj;
    }
}
