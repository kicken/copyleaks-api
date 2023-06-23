<?php

namespace Kicken\Copyleaks\Model\Webhook\Scans\Helpers;

class RepositoryMetadata extends ResultItemMetadata {
    public string $submittedBy;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        self::setStandardProperties($json, $obj);
        $obj->submittedBy = $json->submittedBy ?? '';

        return $obj;
    }
}
