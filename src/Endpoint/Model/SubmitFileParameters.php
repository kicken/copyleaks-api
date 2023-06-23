<?php


namespace Kicken\Copyleaks\Endpoint\Model;


use Kicken\Copyleaks\Endpoint\Model\Internal\Properties;
use Kicken\Copyleaks\Endpoint\Model\Internal\SubmitParameters;

class SubmitFileParameters extends SubmitParameters {
    public string $base64;
    public string $filename;

    public function __construct(string $base64, string $filename, string $scanId, string $statusHook, ?Properties $extraProperties = null){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->base64 = $base64;
        $this->filename = $filename;
    }
}
