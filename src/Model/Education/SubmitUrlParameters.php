<?php


namespace Kicken\Copyleaks\Model\Education;


class SubmitUrlParameters extends SubmitParameters {
    /** @var string */
    public $url;

    public function __construct(string $url, string $scanId, string $statusHook, array $extraProperties = []){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->url = $url;
    }

    public function jsonSerialize(){
        return [
            'url' => $this->url
            , 'properties' => $this->properties
        ];
    }
}
