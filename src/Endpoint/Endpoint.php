<?php


namespace Kicken\Copyleaks\Endpoint;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Kicken\Copyleaks\ClientFactory;
use Kicken\Copyleaks\Model\ModelSerializer;
use Psr\Log\LoggerInterface;

abstract class Endpoint {
    protected ClientFactory $clientFactory;
    protected LoggerInterface $logger;
    protected bool $sandboxMode = false;
    private ModelSerializer $serializer;

    public function __construct(ClientFactory $factory, LoggerInterface $logger){
        $this->clientFactory = $factory;
        $this->logger = $logger;
        $this->serializer = new ModelSerializer();
    }

    public function enableSandboxMode() : self{
        $this->sandboxMode = true;

        return $this;
    }

    protected function getBaseUri() : string{
        return 'https://api.copyleaks.com/';
    }

    protected function sendRequest(string $method, string $endpoint, ?object $bodyData = null) : EndpointResponse{
        try {
            $options = [
                'base_uri' => $this->getBaseUri()
            ];
            if ($bodyData){
                $options[RequestOptions::HEADERS]['Content-type'] = 'application/json';
                $options[RequestOptions::BODY] = $this->serializer->serialize($bodyData);
            }

            $response = $this->clientFactory->getClient()->request($method, $endpoint, $options);
        } catch (ClientException $ex){
            $response = $ex->getResponse();
        }


        if ($response->getStatusCode() >= 300){
            $this->logger->warning('Bad response status code');
            throw new EndpointException($response, $this->logger);
        }

        return new EndpointResponse($response, $this->logger);
    }
}
