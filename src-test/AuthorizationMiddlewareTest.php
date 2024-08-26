<?php

namespace Kicken\Copyleaks\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Psr7\Request;
use Kicken\Copyleaks\Account\AccessToken;
use Kicken\Copyleaks\AuthorizationCache;
use Kicken\Copyleaks\AuthorizationMiddleware;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\NullLogger;

class AuthorizationMiddlewareTest extends TestCase {
    private const AUTH_URL = 'https://id.copyleaks.com/v3/account/login/api';
    private AuthorizationMiddleware $middleware;
    private MockResponseBuilder $mockResponseBuilder;
    private Client $mockClient;
    private AuthorizationCache $mockCache;
    private ResponseInterface $mockAuthResponse;

    protected function setUp() : void{
        $this->mockResponseBuilder = new MockResponseBuilder($this);
        $this->mockClient = $this->getMockBuilder(Client::class)->getMock();
        $this->mockCache = $this->getMockBuilder(AuthorizationCache::class)->getMock();
        $this->middleware = new AuthorizationMiddleware('test@example.com', 'test', $this->mockClient, new NullLogger(), $this->mockCache);
        $this->mockAuthResponse = $this->mockResponseBuilder->createMockResponse(200, 'Ok', json_encode([
            'access_token' => 'test token',
            '.issued' => date('r'),
            '.expires' => date('r', time() + 600)
        ]));
    }

    public function testHandlerIgnoresAuthUrl(){
        $request = new Request('post', self::AUTH_URL);
        $this->mockCache->expects($this->never())->method('getToken');
        $this->runMiddleware($request);
    }

    public function testAuthRequestMadeOn401(){
        $this->mockClient->expects($this->once())->method('post')
            ->with(self::AUTH_URL, $this->isType('array'))
            ->willReturn($this->mockAuthResponse);
        $this->runMiddleware();
    }

    public function testTokenCacheIsUpdated(){
        $this->mockClient->expects($this->once())->method('post')
            ->with(self::AUTH_URL, $this->isType('array'))
            ->willReturn($this->mockAuthResponse);
        $this->mockCache->expects($this->once())->method('updateToken')->with($this->isInstanceOf(AccessToken::class));
        $this->runMiddleware();
    }

    private function runMiddleware(Request $request = null){
        $request = $request ?? new Request('post', 'https://api.example.com/test');
        $handler = call_user_func($this->middleware, function(){
            $response = $this->mockResponseBuilder->createMockResponse(401, 'Unauthorized');

            return new FulfilledPromise($response);
        });
        $handler($request, []);
    }
}
