<?php


namespace Kicken\Copyleaks\Model\Webhook\Export\Helper;


use Kicken\Copyleaks\Model\JsonConstructable;

class Task implements JsonConstructable {
    public string $endpoint;
    public bool $isHealthy;
    public int $httpStatusCode;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new static();
        $obj->endpoint = $json->endpoint;
        $obj->isHealthy = $json->isHealthy;
        $obj->httpStatusCode = $json->httpStatusCode;

        return $obj;
    }
}
