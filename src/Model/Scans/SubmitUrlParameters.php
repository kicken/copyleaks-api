<?php


namespace Kicken\Copyleaks\Model\Scans;


class SubmitUrlParameters extends SubmitParameters {
    public string $url;
    public ?string $verb = null;
    /** @var string[] */
    public ?array $headers = null;

    public function __construct(string $url, string $scanId, string $statusHook, ?Properties $extraProperties = null){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->url = $url;
    }
}
