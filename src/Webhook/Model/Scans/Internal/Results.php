<?php


namespace Kicken\Copyleaks\Webhook\Model\Scans\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

class Results implements JsonConstructable {
    /** @var InternetResultItem[] */
    public array $internet;
    /** @var DatabaseResultItem[] */
    public array $database;
    /** @var BatchResultItem[] */
    public array $batch;
    /** @var RepositoryResultItem[] */
    public array $repositories;
    /** @var Score */
    public Score $score;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        $obj->internet = array_map(function(\stdClass $v){
            return InternetResultItem::createFromJsonObject($v);
        }, $json->internet ?? []);
        $obj->database = array_map(function(\stdClass $v){
            return DatabaseResultItem::createFromJsonObject($v);
        }, $json->database ?? []);
        $obj->batch = array_map(function(\stdClass $v){
            return BatchResultItem::createFromJsonObject($v);
        }, $json->batch);
        $obj->repositories = array_map(function(\stdClass $v){
            return RepositoryResultItem::createFromJsonObject($v);
        }, $json->repositories);
        $obj->score = Score::createFromJsonObject($json->score);

        return $obj;
    }
}
