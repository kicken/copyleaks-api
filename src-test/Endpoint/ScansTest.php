<?php

namespace Kicken\Copyleaks\Test\Endpoint;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use Kicken\Copyleaks\ClientFactory;
use Kicken\Copyleaks\Endpoint\EndpointException;
use Kicken\Copyleaks\Endpoint\Model\SubmitFileParameters;
use Kicken\Copyleaks\Endpoint\Model\SubmitOCRParameters;
use Kicken\Copyleaks\Endpoint\Model\SubmitUrlParameters;
use Kicken\Copyleaks\Endpoint\Scans;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\NullLogger;

class ScansTest extends TestCase {
    private Client $mockClient;
    private Scans $endpoint;

    public function setUp() : void{
        $this->mockClient = $this->getMockBuilder(Client::class)->getMock();
        $factory = $this->getMockBuilder(ClientFactory::class)->disableOriginalConstructor()->getMock();
        $factory->method('getClient')->willReturn($this->mockClient);
        $this->endpoint = new Scans($factory, new NullLogger());
    }

    public function testSubmitURL(){
        $this->expectNotToPerformAssertions();
        $documentUrl = 'https://example.com/';
        $scanId = 'example';
        $parameters = new SubmitUrlParameters($documentUrl, $scanId, 'https://example.com/{STATUS}');
        $requestMethod = $this->mockClient->method('request');

        $requestMethod->willReturn($this->createMockResponse(201, 'Created'));
        $requestMethod->with('PUT', 'v3/scans/submit/url/' . $scanId, $this->callback(function($value) use ($documentUrl, $scanId){
            $bodyData = $this->parseRequestBodyJson($value);

            return $bodyData->url === $documentUrl && $bodyData->scanId === $scanId;
        }));

        $this->endpoint->submitURL($parameters);
    }

    public function testSubmitFile(){
        $this->expectNotToPerformAssertions();
        $fileContent = base64_encode('Test file data');
        $filename = 'filename.txt';
        $scanId = 'example';
        $parameters = new SubmitFileParameters($fileContent, $filename, $scanId, 'https://example.com/{STATUS}');
        $requestMethod = $this->mockClient->method('request');

        $requestMethod->willReturn($this->createMockResponse(201, 'Created'));
        $requestMethod->with('PUT', 'v3/scans/submit/file/' . $scanId, $this->callback(function($value) use ($fileContent, $filename, $scanId){
            $bodyData = $this->parseRequestBodyJson($value);

            return $bodyData->base64 === $fileContent && $bodyData->filename === $filename && $bodyData->scanId === $scanId;
        }));

        $this->endpoint->submitFile($parameters);
    }

    public function testSubmitOCR(){
        $this->expectNotToPerformAssertions();
        $fileContent = base64_encode('Test file data');
        $filename = 'filename.txt';
        $langCode = 'en';
        $scanId = 'example';
        $parameters = new SubmitOCRParameters($fileContent, $filename, $langCode, $scanId, 'https://example.com/{STATUS}');
        $requestMethod = $this->mockClient->method('request');

        $requestMethod->willReturn($this->createMockResponse(201, 'Created'));
        $requestMethod->with('PUT', 'v3/scans/submit/ocr/' . $scanId, $this->callback(function($value) use ($filename, $fileContent, $scanId, $langCode){
            $bodyData = $this->parseRequestBodyJson($value);

            return $bodyData->base64 === $fileContent && $bodyData->filename === $filename && $bodyData->langCode === $langCode && $bodyData->scanId === $scanId;
        }));

        $this->endpoint->submitOCR($parameters);
    }

    public function testSubmitURLFailedWith400(){
        $this->expectException(EndpointException::class);
        $documentUrl = 'https://example.com/';
        $scanId = 'example';
        $parameters = new SubmitUrlParameters($documentUrl, $scanId, 'https://example.com/{STATUS}');

        $requestMethod = $this->mockClient->method('request');
        $requestMethod->willReturn($this->createMockResponse(400, 'Bad Request'));
        $this->endpoint->submitURL($parameters);
    }

    public function testSubmitURLWithSandboxMode(){
        $this->expectNotToPerformAssertions();
        $documentUrl = 'https://example.com/';
        $scanId = 'example';
        $parameters = new SubmitUrlParameters($documentUrl, $scanId, 'https://example.com/{STATUS}');

        $requestMethod = $this->mockClient->method('request');
        $requestMethod->with($this->anything(), $this->anything(), $this->callback(function($value){
            $bodyData = $this->parseRequestBodyJson($value);

            return $bodyData->properties->sandbox === true;
        }));
        $requestMethod->willReturn($this->createMockResponse(201, 'Created'));
        $this->endpoint->enableSandboxMode();
        $this->endpoint->submitURL($parameters);
    }

    private function createMockResponse(int $code, string $phrase) : ResponseInterface{
        $fp = fopen('php://memory', 'r+');

        $mockResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockResponse->method('getStatusCode')->willReturn($code);
        $mockResponse->method('getReasonPhrase')->willReturn($phrase);
        $mockResponse->method('getBody')->willReturn(new Stream($fp));

        return $mockResponse;
    }

    private function parseRequestBodyJson($requestOptions){
        if (!is_array($requestOptions) || !array_key_exists('json', $requestOptions)){
            throw new \RuntimeException('Invalid request options type');
        }

        $data = json_decode($requestOptions['json']);
        if (json_last_error() !== JSON_ERROR_NONE){
            throw new \RuntimeException(json_last_error_msg());
        }

        return $data;
    }
}
