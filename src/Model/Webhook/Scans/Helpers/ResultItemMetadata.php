<?php

namespace Kicken\Copyleaks\Model\Webhook\Scans\Helpers;

use Kicken\Copyleaks\Model\JsonConstructable;

class ResultItemMetadata implements JsonConstructable {
    public string $finalUrl;
    public string $canonicalUrl;
    public ?\DateTimeInterface $publishDate;
    public ?\DateTimeInterface $creationDate;
    public ?\DateTimeInterface $lastModificationDate;
    public string $author;
    public string $organization;
    public string $filename;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        self::setStandardProperties($json, $obj);

        return $obj;
    }

    protected static function setStandardProperties(\stdClass $json, ResultItemMetadata $obj) : void{
        $obj->finalUrl = $json->finalUrl ?? '';
        $obj->canonicalUrl = $json->canonicalUrl ?? '';
        $obj->publishDate = $json->publishDate ? new \DateTimeImmutable($json->publishDate) : null;
        $obj->creationDate = $json->creationDate ? new \DateTimeImmutable($json->creationDate) : null;
        $obj->lastModificationDate = $json->lastModificationDate ? new \DateTimeImmutable($json->lastModificationDate) : null;
        $obj->author = $json->author ?? '';
        $obj->organization = $json->organization ?? '';
        $obj->filename = $json->filename ?? '';
    }
}
