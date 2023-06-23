<?php


namespace Kicken\Copyleaks\Webhook\Model\Scans\Internal;


class DatabaseResultItem extends ResultItem {
    public string $scanId;
    public ResultItemMetadata $metadata;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        self::setResultItemProperties($json, $obj);
        $obj->scanId = $json->scanId ?? '';
        $obj->metadata=ResultItemMetadata::createFromJsonObject($json->metadata);

        return $obj;
    }
}
