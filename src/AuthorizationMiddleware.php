<?php

namespace Kicken\Copyleaks;

use GuzzleHttp\Client;
use Kicken\Copyleaks\Endpoint\EndpointException;
use Kicken\Copyleaks\Endpoint\EndpointResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class AuthorizationMiddleware {
    private string $email;
    private string $apiKey;
    private Client $client;
    private ?string $token = null;
    private LoggerInterface $logger;

    public function __construct(string $email, string $apiKey, Client $client, LoggerInterface $logger){
        $this->email = $email;
        $this->apiKey = $apiKey;
        $this->client = $client;
        $this->logger = $logger;
    }

    public function __invoke(callable $next) : \Closure{
        return function(RequestInterface $request, array $options) use ($next){
            if ($request->getUri()->getHost() === 'id.copyleaks.com'){
                return $next($request, $options);
            }

            if (!$this->token){
                $this->logger->notice('Fetching authorization token');
                $this->token = $this->fetchAuthenticationToken();
            }

            return $next($this->addAuth($request), $options)->then(function(ResponseInterface $response) use ($next, $request, $options){
                $status = $response->getStatusCode();
                if ($status === 401){
                    $this->logger->notice('Renewing authorization token.');
                    $this->token = $this->fetchAuthenticationToken();

                    return $next($this->addAuth($request), $options);
                } else {
                    return $response;
                }
            });
        };
    }

    private function addAuth(RequestInterface $request) : RequestInterface{
        return $request->withHeader('Authorization', 'Bearer ' . $this->token);
    }

    private function fetchAuthenticationToken() : string{
        $response = $this->client->post('https://id.copyleaks.com/v3/account/login/api', [
            'body' => json_encode(['email' => $this->email, 'key' => $this->apiKey])
            , 'headers' => [
                'Content-type' => 'application/json'
            ]
        ]);
        if ($response->getStatusCode() !== 200){
            $this->logger->error('Unable to obtain authorization token.');
            throw new EndpointException($response, $this->logger);
        }

        $response = new EndpointResponse($response, $this->logger);
        $data = $response->decodeJson();

        return $data->access_token;
    }
}
