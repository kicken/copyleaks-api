<?php


namespace Kicken\Copyleaks\Model\Education;


class SubmitUrlParameters extends SubmitParameters {
    public string $url;

    public function __construct(string $url, string $scanId, string $statusHook, array $extraProperties = []){
        parent::__construct($scanId, $statusHook, $extraProperties);
        $this->url = $url;
    }

    public function jsonSerialize() : array{
        return [
            'url' => $this->url
            , 'properties' => $this->properties
        ];
    }
}
