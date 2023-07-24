<?php

namespace Kicken\Copyleaks\Test;

use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class MockResponseBuilder {
    private TestCase $testCase;

    public function __construct(TestCase $testCase){
        $this->testCase = $testCase;
    }

    public function createMockResponse(int $code, string $phrase, string $content = '') : ResponseInterface{
        $fp = fopen('php://memory', 'r+');
        fwrite($fp, $content);
        rewind($fp);

        /** @var MockObject|ResponseInterface $mockResponse */
        $mockResponse = $this->testCase->getMockBuilder(ResponseInterface::class)->getMock();
        $mockResponse->method('getStatusCode')->willReturn($code);
        $mockResponse->method('getReasonPhrase')->willReturn($phrase);
        $mockResponse->method('getBody')->willReturn(new Stream($fp));

        return $mockResponse;
    }
}
