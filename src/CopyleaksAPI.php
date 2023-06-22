<?php


namespace Kicken\Copyleaks;


use Kicken\Copyleaks\Endpoint\Business;
use Kicken\Copyleaks\Endpoint\Download;
use Kicken\Copyleaks\Endpoint\Education;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class CopyleaksAPI implements LoggerAwareInterface {
    private ClientFactory $factory;
    private LoggerInterface $logger;

    public function __construct(string $email, string $apiKey, array $clientOptions = []){
        $this->factory = new ClientFactory($email, $apiKey, $clientOptions);
        $this->logger = new NullLogger();
    }

    public function setLogger(LoggerInterface $logger){
        $this->logger = $logger;
        $this->factory->setLogger($logger);
    }

    public function education() : Education{
        return new Education($this->factory, $this->logger);
    }

    public function business() : Business{
        return new Business($this->factory, $this->logger);
    }

    public function download() : Download{
        return new Download($this->factory, $this->logger);
    }
}
