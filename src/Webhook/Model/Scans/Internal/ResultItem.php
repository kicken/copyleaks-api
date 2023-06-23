<?php


namespace Kicken\Copyleaks\Webhook\Model\Scans\Internal;


use Kicken\Copyleaks\Model\JsonConstructable;

abstract class ResultItem implements JsonConstructable {
    public string $id;
    public string $title;
    public string $introduction;
    public int $matchedWords;

    protected static function setResultItemProperties(\stdClass $json, ResultItem $obj) : self{
        $obj->id = $json->id;
        $obj->title = $json->title;
        $obj->introduction = $json->introduction;
        $obj->matchedWords = $json->matchedWords;

        return $obj;
    }
}
