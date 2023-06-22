<?php


namespace Kicken\Copyleaks\Endpoint;


use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class EndpointResponse {
    private ResponseInterface $response;
    private LoggerInterface $logger;

    public function __construct(ResponseInterface $response, LoggerInterface $logger){
        $this->response = $response;
        $this->logger = $logger;
    }

    public function bodyContent() : string{
        $bodyStream = $this->response->getBody();
        $bodyStream->rewind();

        return $bodyStream->getContents();
    }

    public function decodeJson() : \stdClass{
        $bodyContent = $this->bodyContent();
        if (trim($bodyContent) === ''){
            return new \stdClass();
        }

        if ($this->response->hasHeader('Content-type')){
            $contentType = $this->response->getHeaderLine('Content-type');
            [$contentType] = explode(';', $contentType);
            $contentType = strtolower(trim($contentType));
            if ($contentType !== 'application/json'){
                $this->logger->warning('Invalid content-type header', [
                    'content-type' => $contentType
                ]);
                throw new EndpointException($this->response, $this->logger);
            }
        }

        $data = json_decode($bodyContent);
        if (json_last_error() !== JSON_ERROR_NONE){
            $this->logger->warning('JSON Parsing failed.', [
                'error' => json_last_error(),
                'message' => json_last_error_msg(),
                'body' => $bodyContent
            ]);
            throw new EndpointException($this->response, $this->logger);
        }

        return $data;
    }
}
