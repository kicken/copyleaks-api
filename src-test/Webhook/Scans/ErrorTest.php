<?php

namespace Kicken\Copyleaks\Test\Webhook\Scans;

use Kicken\Copyleaks\Webhook\Model\Scans\Error;
use PHPUnit\Framework\TestCase;

class ErrorTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "status": 1,
  "error": {
    "message": "You don\'t have enough credits to complete the request (required 10 credits)!",
    "code": "13"
  },
  "developerPayload": "Custom developer payload"
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = Error::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->status, $result->status);
        $this->assertEquals($this->sampleResponse->developerPayload, $result->developerPayload);
        $this->assertEquals($this->sampleResponse->error->message, $result->error->message);
        $this->assertEquals($this->sampleResponse->error->code, $result->error->code);
    }
}
