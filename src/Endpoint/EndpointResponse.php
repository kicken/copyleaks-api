<?php


namespace Kicken\Copyleaks\Endpoint;


use Psr\Http\Message\ResponseInterface;

class EndpointResponse {
    private $response;

    public function __construct(ResponseInterface $response){
        $this->response = $response;
    }

    public function bodyContent(){
        $bodyStream = $this->response->getBody();
        $bodyStream->rewind();

        return $bodyStream->getContents();
    }

    public function decodeJson(){
        $contentType = $this->response->getHeaderLine('Content-type');
        [$contentType] = explode(';', $contentType);
        $contentType = strtolower(trim($contentType));
        if ($contentType !== 'application/json'){
            throw new EndpointException($this->response);
        }

        return json_decode($this->bodyContent());
    }
}
