<?php


namespace Kicken\Copyleaks\Model\Education;


class SubmitOCRParameters extends SubmitParameters {
    public string $base64;
    public string $filename;
    public string $langCode;

    public function __construct(string $base64, string $filename, string $langCode, string $scanId, string $statusHook, array $extraProperties = []){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->base64 = $base64;
        $this->filename = $filename;
        $this->langCode = $langCode;
    }

    public function jsonSerialize() : array{
        return [
            'base64' => $this->base64
            , 'filename' => $this->filename
            , 'langCode' => $this->langCode
            , 'properties' => $this->properties
        ];
    }
}
