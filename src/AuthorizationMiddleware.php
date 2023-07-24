<?php

namespace Kicken\Copyleaks;

use GuzzleHttp\Client;
use Kicken\Copyleaks\Account\AccessToken;
use Kicken\Copyleaks\Endpoint\EndpointException;
use Kicken\Copyleaks\Endpoint\EndpointResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class AuthorizationMiddleware {
    private string $email;
    private string $apiKey;
    private Client $client;
    private AuthorizationCache $authCache;
    private LoggerInterface $logger;

    public function __construct(string $email, string $apiKey, Client $client, LoggerInterface $logger, AuthorizationCache $authCache){
        $this->email = $email;
        $this->apiKey = $apiKey;
        $this->client = $client;
        $this->logger = $logger;
        $this->authCache = $authCache;
    }

    public function __invoke(callable $next) : \Closure{
        return function(RequestInterface $request, array $options) use ($next){
            if ($request->getUri()->getHost() === 'id.copyleaks.com'){
                return $next($request, $options);
            }


            $token = $this->authCache->getToken();
            if (!$token || $token->isExpired()){
                $this->logger->notice('Fetching authorization token');
                $token = $this->fetchAuthenticationToken();
                $this->authCache->updateToken($token);
            }

            return $next($this->addAuth($request, $token->accessToken), $options)->then(function(ResponseInterface $response) use ($next, $request, $options){
                $status = $response->getStatusCode();
                if ($status === 401){
                    $this->logger->notice('Renewing authorization token.');
                    $token = $this->fetchAuthenticationToken();
                    $this->authCache->updateToken($token);

                    return $next($this->addAuth($request, $token->accessToken), $options);
                } else {
                    return $response;
                }
            });
        };
    }

    private function addAuth(RequestInterface $request, string $token) : RequestInterface{
        return $request->withHeader('Authorization', 'Bearer ' . $token);
    }

    private function fetchAuthenticationToken() : AccessToken{
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

        return new AccessToken($response->decodeJson());
    }
}
