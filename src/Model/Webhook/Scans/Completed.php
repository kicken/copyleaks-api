<?php


namespace Kicken\Copyleaks\Model\Webhook\Scans;


use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Model\Webhook\Scans\Helpers\Notifications;
use Kicken\Copyleaks\Model\Webhook\Scans\Helpers\Results;
use Kicken\Copyleaks\Model\Webhook\Scans\Helpers\ScannedDocument;

class Completed implements JsonConstructable {
    public int $status;
    public string $developerPayload;
    public ScannedDocument $scannedDocument;
    public Results $results;
    public Notifications $notifications;

    public static function createFromJsonObject(\stdClass $json) : self{
        $obj = new self;
        $obj->status = $json->status;
        $obj->developerPayload = $json->developerPayload;
        $obj->scannedDocument = ScannedDocument::createFromJsonObject($json->scannedDocument);
        $obj->results = Results::createFromJsonObject($json->results);
        $obj->notifications = Notifications::createFromJsonObject($json->notifications);

        return $obj;
    }
}
