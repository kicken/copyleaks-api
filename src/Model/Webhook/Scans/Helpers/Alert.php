<?php

namespace Kicken\Copyleaks\Model\Webhook\Scans\Helpers;

use Kicken\Copyleaks\Model\JsonConstructable;

class Alert implements JsonConstructable {
    public string $code;
    public string $title;
    public string $message;
    public string $helpLink;
    public int $severity;
    public string $additionalData;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        $obj->code = $json->code ?? '';
        $obj->title = $json->title ?? '';
        $obj->message = $json->message ?? '';
        $obj->helpLink = $json->helpLink ?? '';
        $obj->severity = $json->severity ?? '';
        $obj->additionalData = $json->additionalData ?? '';

        return $obj;
    }
}
