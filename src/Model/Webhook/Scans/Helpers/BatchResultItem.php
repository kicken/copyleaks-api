<?php

namespace Kicken\Copyleaks\Model\Webhook\Scans\Helpers;

class BatchResultItem extends ResultItem {
    public string $scanId;
    public ResultItemMetadata $metadata;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        self::setResultItemProperties($json, $obj);
        $obj->scanId = $json->scanId ?? '';
        $obj->metadata = ResultItemMetadata::createFromJsonObject($json->metadata);

        return $obj;
    }
}
