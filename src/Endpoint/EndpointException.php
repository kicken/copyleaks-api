<?php


namespace Kicken\Copyleaks\Endpoint;


use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class EndpointException extends \Exception {
    private ?ResponseInterface $response;

    public function __construct(?ResponseInterface $response, LoggerInterface $logger){
        parent::__construct('Invalid endpoint response', $response ? $response->getStatusCode() : 0);
        $this->response = $response;
        $context = ['trace' => $this->getTrace()];
        if ($response){
            $context = array_merge($context, [
                'statusCode' => $response->getStatusCode(),
                'reasonPhrase' => $response->getReasonPhrase(),
                'headers' => $response->getHeaders(),
                'body' => $response->getBody()->getContents()
            ]);
        }
        $logger->warning($this->getMessage(), $context);
    }

    public function getResponse() : ?ResponseInterface{
        return $this->response;
    }
}
