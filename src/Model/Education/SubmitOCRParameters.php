<?php


namespace Kicken\Copyleaks\Model\Education;


class SubmitOCRParameters extends SubmitParameters {
    /** @var string */
    public $base64;
    /** @var string */
    public $filename;
    /** @var string */
    public $langCode;

    public function __construct(string $base64, string $filename, string $langCode, string $scanId, string $statusHook, array $extraProperties = []){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->base64 = $base64;
        $this->filename = $filename;
        $this->langCode = $langCode;
    }

    public function jsonSerialize(){
        return [
            'base64' => $this->base64
            , 'filename' => $this->filename
            , 'langCode' => $this->langCode
            , 'properties' => $this->properties
        ];
    }
}
