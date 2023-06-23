<?php


namespace Kicken\Copyleaks\Webhook\Model\Scans;


use Kicken\Copyleaks\Model\JsonConstructable;
use Kicken\Copyleaks\Webhook\Model\Scans\Internal\Notifications;
use Kicken\Copyleaks\Webhook\Model\Scans\Internal\Results;
use Kicken\Copyleaks\Webhook\Model\Scans\Internal\ScannedDocument;

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
