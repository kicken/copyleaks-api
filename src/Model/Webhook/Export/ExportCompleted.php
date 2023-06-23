<?php


namespace Kicken\Copyleaks\Model\Webhook\Export;


use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Model\Webhook\Export\Helper\Task;

class ExportCompleted implements JsonConstructable {
    public bool $completed;
    public string $developerPayload;
    /** @var Task[]  */
    public array $tasks;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new static();
        $obj->completed = $json->completed;
        $obj->developerPayload = $json->developerPayload;
        $obj->tasks = array_map(function(\stdClass $json){
            return Task::createFromJsonObject($json);
        }, $json->tasks);

        return $obj;
    }
}
