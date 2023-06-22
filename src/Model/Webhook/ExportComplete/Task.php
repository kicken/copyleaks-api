<?php


namespace Kicken\Copyleaks\Model\Webhook\ExportComplete;


use Kicken\Copyleaks\Model\JsonConstructable;

class Task implements JsonConstructable {
    public string $endpoint;
    public int $httpStatusCode;
    public bool $isHealthy;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->endpoint = $json->endpoint;
        $self->httpStatusCode = $json->httpStatusCode;
        $self->isHealthy = $json->isHealthy;

        return $self;
    }
}
