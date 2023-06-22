<?php


namespace Kicken\Copyleaks\Model\Webhook;


use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Model\Webhook\Completed\Results;
use Kicken\Copyleaks\Model\Webhook\Completed\ScannedDocument;

class Completed implements JsonConstructable {
    public ScannedDocument $scannedDocument;
    public Results $results;

    public static function createFromJsonObject(\stdClass $json) : self{
        $self = new self;
        $self->scannedDocument = ScannedDocument::createFromJsonObject($json->scannedDocument);
        $self->results = Results::createFromJsonObject($json->results);

        return $self;
    }
}
