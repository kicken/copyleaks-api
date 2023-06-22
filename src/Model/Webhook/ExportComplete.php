<?php


namespace Kicken\Copyleaks\Model\Webhook;


use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Model\Webhook\ExportComplete\Task;

class ExportComplete implements JsonConstructable {
    public bool $completed;
    public array $tasks;
    public string $developerPayload;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->completed = $json->completed;
        $self->tasks = array_map(function(\stdClass $json){
            return Task::createFromJsonObject($json);
        }, $json->tasks);
        $self->developerPayload = $json->developerPayload;

        return $self;
    }
}
