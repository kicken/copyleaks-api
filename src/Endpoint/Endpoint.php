<?php


namespace Kicken\Copyleaks\Endpoint;


use GuzzleHttp\Exception\ClientException;
use Kicken\Copyleaks\ClientFactory;
use Psr\Log\LoggerInterface;

abstract class Endpoint {
    protected ClientFactory $clientFactory;
    protected LoggerInterface $logger;

    public function __construct(ClientFactory $factory, LoggerInterface $logger){
        $this->clientFactory = $factory;
        $this->logger = $logger;
    }

    abstract protected function getBaseUri() : string;

    protected function sendRequest(string $method, string $endpoint, $bodyData = null) : EndpointResponse{
        try {
            $options = [
                'base_uri' => $this->getBaseUri()
            ];
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
