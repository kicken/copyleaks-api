<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


use Kicken\Copyleaks\Model\JsonConstructable;

class Results implements JsonConstructable {
    /** @var InternetResultItem[] */
    public $internet;
    /** @var DatabaseResultItem[] */
    public $database;
    /** @var array */
    public $batch;
    /** @var Score */
    public $score;

    public static function createFromJsonObject(\stdClass $json){
        $self = new self;
        $self->internet = array_map(function(\stdClass $v){
            return InternetResultItem::createFromJsonObject($v);
        }, $json->internet ?? []);
        $self->database = array_map(function(\stdClass $v){
            return DatabaseResultItem::createFromJsonObject($v);
        }, $json->database ?? []);;
        $self->batch = $json->batch;
        $self->score = Score::createFromJsonObject($json->score);

        return $self;
    }
}
