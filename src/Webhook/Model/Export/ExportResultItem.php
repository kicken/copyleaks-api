<?php


namespace Kicken\Copyleaks\Webhook\Model\Export;

use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Webhook\Model\Export\Internal\ResultItemContent;
use Kicken\Copyleaks\Webhook\Model\Export\Internal\Statistics;

class ExportResultItem implements JsonConstructable {
    public Statistics $statistics;
    public ResultItemContent $text;
    public ResultItemContent $html;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new self();
        $self->statistics = Statistics::createFromJsonObject($json->statistics);
        $self->text = ResultItemContent::createFromJsonObject($json->text);
        if ($json->html && get_object_vars($json->html)){
            $self->html = ResultItemContent::createFromJsonObject($json->html);
        }

        return $self;
    }
}
