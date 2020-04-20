<?php


namespace Kicken\Copyleaks\Model\Education;


class SubmitFileParameters extends SubmitParameters {
    /** @var string */
    public $base64;
    /** @var string */
    public $filename;

    public function __construct(string $base64, string $filename, string $scanId, string $statusHook, array $extraProperties = []){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->base64 = $base64;
        $this->filename = $filename;
    }

    public function jsonSerialize(){
        return [
            'base64' => $this->base64
            , 'filename' => $this->filename
            , 'properties' => $this->properties
        ];
    }
}
