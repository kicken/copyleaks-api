<?php

namespace Kicken\Copyleaks\Webhook\Model\Scans;

use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Webhook\Model\Scans\Internal\ErrorDetail;

class Error implements JsonConstructable {
    public int $status;
    public ErrorDetail $error;
    public string $developerPayload;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        $obj->status = $json->status ?? 1;
        $obj->error = ErrorDetail::createFromJsonObject($json->error ?? new \stdClass());
        $obj->developerPayload = $json->developerPayload ?? '';

        return $obj;
    }
}
