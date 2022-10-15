<?php


namespace Kicken\Copyleaks;


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ClientFactory implements LoggerAwareInterface {
    private $client;
    private $email;
    private $apiKey;
    private $clientOptions;
    private $logger;

    public function __construct(string $email, string $apiKey, array $clientOptions){
        $this->email = $email;
        $this->apiKey = $apiKey;
        $this->logger = new NullLogger();
        $this->setClientOptions($clientOptions);
    }

    public function setLogger(LoggerInterface $logger){
        $this->client = null;
        $this->logger = $logger;
    }

    public function setClientOptions($options){
        $this->client = null;
        $this->clientOptions = $options;
    }

    public function getClient() : Client{
        return $this->client ?? $this->createClient();
    }

    private function createClient() : Client{
        $stack = HandlerStack::create();
        $options = array_merge_recursive([
            'timeout' => 30
            , 'handler' => $stack
        ], $this->clientOptions);

        $this->client = new Client($options);
        $stack->push(Middleware::log($this->logger, new MessageFormatter(MessageFormatter::DEBUG)));
        $stack->push(new AuthorizationMiddleware($this->email, $this->apiKey, $this->client));


        return $this->client;
    }
}
