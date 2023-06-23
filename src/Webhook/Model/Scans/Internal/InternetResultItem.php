<?php


namespace Kicken\Copyleaks\Webhook\Model\Scans\Internal;


class InternetResultItem extends ResultItem {
    public string $url;
    public ResultItemMetadata $metadata;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        self::setResultItemProperties($json, $obj);
        $obj->url = $json->url ?? '';
        $obj->metadata=ResultItemMetadata::createFromJsonObject($json->metadata);

        return $obj;
    }
}
