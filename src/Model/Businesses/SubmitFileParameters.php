<?php


namespace Kicken\Copyleaks\Model\Businesses;


class SubmitFileParameters extends SubmitParameters {
    public string $base64;
    public string $filename;

    public function __construct(string $base64, string $filename, string $scanId, string $statusHook, array $extraProperties = []){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->base64 = $base64;
        $this->filename = $filename;
    }

    public function jsonSerialize() : array{
        return [
            'base64' => $this->base64
            , 'filename' => $this->filename
            , 'properties' => $this->properties
        ];
    }
}
