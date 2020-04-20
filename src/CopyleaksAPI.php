<?php


namespace Kicken\Copyleaks;


use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Kicken\Copyleaks\Endpoint\Account;
use Kicken\Copyleaks\Endpoint\Download;
use Kicken\Copyleaks\Endpoint\Education;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class CopyleaksAPI implements LoggerAwareInterface {
    private $clientOptions;
    private $authorization;
    private $factory;
    private $logger;

    public function __construct(string $authorization = null, array $clientOptions = []){
        $this->authorization = $authorization;
        $this->clientOptions = $clientOptions;
        $this->factory = new ClientFactory();
        $this->logger = new NullLogger();
        $this->updateFactory();
    }

    public function setLogger(LoggerInterface $logger){
        $this->logger = $logger;
        $this->updateFactory();
    }

    public function setClientOptions(array $clientOptions){
        $this->clientOptions = $clientOptions;
        $this->updateFactory();
    }

    public function setAuthorization(string $authorization){
        $this->authorization = $authorization;
        $this->updateFactory();
    }

    public function account(){
        return new Account($this->factory, $this->logger);
    }

    public function education(){
        return new Education($this->factory, $this->logger);
    }

    public function business(){
        throw new NotImplementedException();
    }

    public function download(){
        return new Download($this->factory, $this->logger);
    }

    private function updateFactory(){
        $loggerMiddleware = Middleware::log($this->logger, new MessageFormatter(MessageFormatter::DEBUG));
        $stack = HandlerStack::create();
        $stack->push($loggerMiddleware);

        $headers = [];
        if ($this->authorization){
            $headers['Authorization'] = 'Bearer ' . $this->authorization;
        }

        $options = array_merge_recursive([
            'timeout' => 30
            , 'handler' => $stack
            , 'headers' => $headers
        ], $this->clientOptions);

        $this->factory->setClientOptions($options);
    }
}
