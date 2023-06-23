<?php


namespace Kicken\Copyleaks\Endpoint\Model;


class ResultParameters {
    public ?string $id = null;
    public ?string $endpoint = null;
    public ?string $verb = null;
    public ?array $headers = null;

    public function __construct(?string $id = null, ?string $url = null){
        $this->id = $id;
        $this->endpoint = $url;
        if ($this->id && $this->endpoint){
            $this->verb = 'POST';
        }
    }
}
