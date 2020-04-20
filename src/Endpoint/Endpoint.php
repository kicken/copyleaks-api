<?php


namespace Kicken\Copyleaks\Endpoint;


use GuzzleHttp\Exception\ClientException;
use Kicken\Copyleaks\ClientFactory;
use Psr\Log\LoggerInterface;

abstract class Endpoint {
    protected $clientFactory;
    protected $logger;

    public function __construct(ClientFactory $factory, LoggerInterface $logger){
        $this->clientFactory = $factory;
        $this->clientFactory->setBaseUri($this->getBaseUri());
        $this->logger = $logger;
    }

    abstract protected function getBaseUri();

    protected function sendRequest(string $method, string $endpoint, $bodyData = null) : EndpointResponse{
        try {
            $options = [];
            if ($bodyData){
                $options['json'] = $bodyData;
            }

            $response = $this->clientFactory->getClient()->request($method, $endpoint, $options);
        } catch (ClientException $ex){
            $response = $ex->getResponse();
        }

        if (!$response || $response->getStatusCode() >= 300){
            throw new EndpointException($response);
        }

        return new EndpointResponse($response);
    }
}
