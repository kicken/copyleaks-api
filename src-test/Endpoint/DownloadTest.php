<?php

namespace Kicken\Copyleaks\Test\Endpoint;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use Kicken\Copyleaks\ClientFactory;
use Kicken\Copyleaks\Endpoint\Download;
use Kicken\Copyleaks\Endpoint\EndpointException;
use Kicken\Copyleaks\Endpoint\Model\ExportParameters;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\NullLogger;

class DownloadTest extends TestCase {
    private Client $mockClient;
    private Download $endpoint;

    public function setUp() : void{
        $this->mockClient = $this->getMockBuilder(Client::class)->getMock();
        $factory = $this->getMockBuilder(ClientFactory::class)->disableOriginalConstructor()->getMock();
        $factory->method('getClient')->willReturn($this->mockClient);
        $this->endpoint = new Download($factory, new NullLogger());
    }

    public function testExportSuccess(){
        $params = new ExportParameters('scanId', 'exportId', 'completionHook');

        $this->expectNotToPerformAssertions();

        $this->mockClient->method('request')->with(
            'POST',
            sprintf('v3/downloads/%s/export/%s', $params->scanId, $params->exportId),
            $this->callback(function($value) use ($params){
                $data = $this->parseRequestBodyJson($value);

                return $data->completionWebhook === $params->completionWebhook;
            })
        )->willReturn($this->createMockResponse(204, 'No content'));
        $this->endpoint->export($params);
    }

    public function testExportFailedWith404(){
        $this->expectException(EndpointException::class);
        $params = new ExportParameters('scanId', 'exportId', 'completionHook');

        $this->mockClient->method('request')->with(
            'POST',
            sprintf('v3/downloads/%s/export/%s', $params->scanId, $params->exportId)
        )->willReturn($this->createMockResponse(404, 'Not found'));
        $this->endpoint->export($params);
    }

    private function createMockResponse(int $code, string $phrase) : ResponseInterface{
        $fp = fopen('php://memory', 'r+');

        $mockResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockResponse->method('getStatusCode')->willReturn($code);
        $mockResponse->method('getReasonPhrase')->willReturn($phrase);
        $mockResponse->method('getBody')->willReturn(new Stream($fp));

        return $mockResponse;
    }

    private function parseRequestBodyJson($requestOptions) : \stdClass{
        if (!is_array($requestOptions) || !array_key_exists('body', $requestOptions)){
            throw new \RuntimeException('Invalid request options type');
        }

        $data = json_decode($requestOptions['body']);
        if (json_last_error() !== JSON_ERROR_NONE){
            throw new \RuntimeException(json_last_error_msg());
        }

        return $data;
    }
}
