<?php


namespace Kicken\Copyleaks;


use Kicken\Copyleaks\Endpoint\Download;
use Kicken\Copyleaks\Endpoint\Scans;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class CopyleaksAPI implements LoggerAwareInterface {
    private ClientFactory $factory;
    private LoggerInterface $logger;

    public function __construct(string $email, string $apiKey, array $clientOptions = [], AuthorizationCache $authorizationCache = null){
        $this->factory = new ClientFactory($email, $apiKey, $clientOptions, $authorizationCache);
        $this->setLogger(new NullLogger());
    }

    public function setLogger(LoggerInterface $logger){
        $this->logger = $logger;
        $this->factory->setLogger($logger);
    }

    public function scans() : Scans{
        return new Scans($this->factory, $this->logger);
    }

    public function downloads() : Download{
        return new Download($this->factory, $this->logger);
    }
}
