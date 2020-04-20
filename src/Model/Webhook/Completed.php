<?php


namespace Kicken\Copyleaks\Model\Webhook;


use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Model\Webhook\Completed\Results;
use Kicken\Copyleaks\Model\Webhook\Completed\ScannedDocument;

class Completed implements JsonConstructable {
    /** @var ScannedDocument */
    public $scannedDocument;
    /** @var Results */
    public $results;

    public static function createFromJsonObject(\stdClass $json){
        $self = new self;
        $self->scannedDocument = ScannedDocument::createFromJsonObject($json->scannedDocument);
        $self->results = Results::createFromJsonObject($json->results);

        return $self;
    }
}
