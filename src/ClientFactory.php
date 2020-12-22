<?php


namespace Kicken\Copyleaks;


use GuzzleHttp\Client;

class ClientFactory {
    private $client;
    private $clientOptions;

    public function setClientOptions($options){
        $this->client = null;
        $this->clientOptions = $options;
    }

    public function getClient(){
        return $this->client ?? $this->createClient();
    }

    private function createClient() : Client{
        $this->client = new Client($this->clientOptions);

        return $this->client;
    }
}
