<?php

namespace Kicken\Copyleaks\Webhook\Model\Scans\Internal;

use Kicken\Copyleaks\Model\JsonConstructable;

class ErrorDetail implements JsonConstructable {
    public int $code;
    public string $message;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        $obj->code = $json->code ?? 0;
        $obj->message = $json->message ?? '';

        return $obj;
    }
}
