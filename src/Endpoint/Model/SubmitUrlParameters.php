<?php


namespace Kicken\Copyleaks\Endpoint\Model;


use Kicken\Copyleaks\Endpoint\Model\Internal\Properties;
use Kicken\Copyleaks\Endpoint\Model\Internal\SubmitParameters;

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
