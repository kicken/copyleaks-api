<?php

namespace Kicken\Copyleaks;

use GuzzleHttp\Client;
use Kicken\Copyleaks\Endpoint\EndpointException;
use Kicken\Copyleaks\Endpoint\EndpointResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthorizationMiddleware {
    private $email;
    private $apiKey;
    private $client;
    private $token = null;

    public function __construct(string $email, string $apiKey, Client $client){
        $this->email = $email;
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    public function __invoke(callable $next) : \Closure{
        return function(RequestInterface $request, array $options) use ($next){
            if ($request->getUri()->getHost() === 'id.copyleaks.com'){
                return $next($request, $options);
            }

            if (!$this->token){
                $this->token = $this->fetchAuthenticationToken();
            }

            return $next($this->addAuth($request), $options)->then(function(ResponseInterface $response) use ($next, $request, $options){
                $status = $response->getStatusCode();
                if ($status === 200){
                    return $response;
                } else if ($status === 401){
                    $this->token = $this->fetchAuthenticationToken();

                    return $next($this->addAuth($request), $options);
                } else {
                    throw new EndpointException($response);
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
            throw new EndpointException($response);
        }

        $response = new EndpointResponse($response);
        $data = $response->decodeJson();

        return $data->access_token;
    }
}
