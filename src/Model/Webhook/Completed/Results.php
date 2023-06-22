<?php


namespace Kicken\Copyleaks\Model\Webhook\Completed;


use Kicken\Copyleaks\Model\JsonConstructable;

class Results implements JsonConstructable {
    /** @var InternetResultItem[] */
    public array $internet;
    /** @var DatabaseResultItem[] */
    public array $database;
    /** @var array */
    public array $batch;
    /** @var Score */
    public Score $score;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new self;
        $self->internet = array_map(function(\stdClass $v){
            return InternetResultItem::createFromJsonObject($v);
        }, $json->internet ?? []);
        $self->database = array_map(function(\stdClass $v){
            return DatabaseResultItem::createFromJsonObject($v);
        }, $json->database ?? []);
        $self->batch = $json->batch;
        $self->score = Score::createFromJsonObject($json->score);

        return $self;
    }
}
