<?php

namespace Kicken\Copyleaks\Model\Webhook\Scans;

use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Model\Webhook\Scans\Helpers\BatchResultItem;
use Kicken\Copyleaks\Model\Webhook\Scans\Helpers\DatabaseResultItem;
use Kicken\Copyleaks\Model\Webhook\Scans\Helpers\InternetResultItem;
use Kicken\Copyleaks\Model\Webhook\Scans\Helpers\RepositoryResultItem;

class NewResult implements JsonConstructable {
    public float $score;
    public string $developerPayload;
    /** @var InternetResultItem[] */
    public array $internet;
    /** @var DatabaseResultItem[] */
    public array $database;
    /** @var BatchResultItem[] */
    public array $batch;
    /** @var RepositoryResultItem[] */
    public array $repositories;

    public static function createFromJsonObject(\stdClass $json) : JsonConstructable{
        $obj = new self;
        $obj->score = $json->score ?? 0;
        $obj->developerPayload = $json->developerPayload ?? '';
        $obj->internet = array_map(function(\stdClass $v){
            return InternetResultItem::createFromJsonObject($v);
        }, $json->internet ?? []);
        $obj->database = array_map(function(\stdClass $v){
            return DatabaseResultItem::createFromJsonObject($v);
        }, $json->database ?? []);
        $obj->batch = array_map(function(\stdClass $v){
            return BatchResultItem::createFromJsonObject($v);
        }, $json->batch ?? []);
        $obj->repositories = array_map(function(\stdClass $v){
            return RepositoryResultItem::createFromJsonObject($v);
        }, $json->repositories ?? []);

        return $obj;
    }
}
