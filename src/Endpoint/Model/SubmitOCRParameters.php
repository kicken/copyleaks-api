<?php


namespace Kicken\Copyleaks\Endpoint\Model;


use Kicken\Copyleaks\Endpoint\Model\Internal\Properties;
use Kicken\Copyleaks\Endpoint\Model\Internal\SubmitParameters;

class SubmitOCRParameters extends SubmitParameters {
    public string $base64;
    public string $filename;
    public string $langCode;

    public function __construct(string $base64, string $filename, string $langCode, string $scanId, string $statusHook, ?Properties $extraProperties = null){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->base64 = $base64;
        $this->filename = $filename;
        $this->langCode = $langCode;
    }
}
