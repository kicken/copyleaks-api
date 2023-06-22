<?php


namespace Kicken\Copyleaks\Endpoint;


use Psr\Http\Message\ResponseInterface;

class EndpointException extends \Exception {
    private ?ResponseInterface $response;

    public function __construct(?ResponseInterface $response){
        parent::__construct('Invalid endpoint response', $response ? $response->getStatusCode() : 0);
        $this->response = $response;
    }

    public function getResponse() : ?ResponseInterface{
        return $this->response;
    }
}
