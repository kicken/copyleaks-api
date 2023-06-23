<?php

namespace Kicken\Copyleaks\Test\Webhook\Scans;

use Kicken\Copyleaks\Webhook\Model\Scans\CreditsChecked;
use PHPUnit\Framework\TestCase;

class CreditsCheckedTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "status": 2,
  "developerPayload": "Custom developer payload",
  "credits": 1
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = CreditsChecked::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->status, $result->status);
        $this->assertEquals($this->sampleResponse->developerPayload, $result->developerPayload);
        $this->assertEquals($this->sampleResponse->credits, $result->credits);
    }
}
