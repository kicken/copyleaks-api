<?php

namespace Kicken\Copyleaks\Test\Webhook\Scans;

use Kicken\Copyleaks\Webhook\Model\Scans\Indexed;
use PHPUnit\Framework\TestCase;

class IndexedTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "status": 3,
  "developerPayload": "Custom developer payload"
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = Indexed::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->status, $result->status);
        $this->assertEquals($this->sampleResponse->developerPayload, $result->developerPayload);
    }
}
