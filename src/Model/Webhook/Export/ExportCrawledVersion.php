<?php


namespace Kicken\Copyleaks\Model\Webhook\Export;


use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Model\Webhook\Export\Helper\CrawledVersionContent;
use Kicken\Copyleaks\Model\Webhook\Export\Helper\Metadata;

class ExportCrawledVersion implements JsonConstructable {
    public Metadata $metadata;
    public CrawledVersionContent $html;
    public CrawledVersionContent $text;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new static();
        $self->metadata = Metadata::createFromJsonObject($json->metadata);
        $self->text = CrawledVersionContent::createFromJsonObject($json->text);
        $self->html = CrawledVersionContent::createFromJsonObject($json->html ?? new \stdClass());

        return $self;
    }
}
