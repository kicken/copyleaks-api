<?php

namespace Kicken\Copyleaks\Webhook\Model\Scans\Internal;

class RepositoryResultItem extends ResultItem {
    public string $scanId;
    public string $repositoryId;
    public RepositoryMetadata $metadata;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        self::setResultItemProperties($json, $obj);
        $obj->scanId = $json->scanId ?? '';
        $obj->repositoryId = $json->repositoryId ?? '';
        $obj->metadata = RepositoryMetadata::createFromJsonObject($json->metadata);

        return $obj;
    }
}
