<?php

namespace Kicken\Copyleaks\Test\Webhook\Export;

use Kicken\Copyleaks\Webhook\Model\Export\ExportCompleted;
use PHPUnit\Framework\TestCase;

class ExportCompletedTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "completed": true,
  "tasks": [
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=14e69784c2",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=pdf",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=crawled",
      "httpStatusCode": 500,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=c322a138d2",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=fb123be210",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=6bb60d399e",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=18660753e2",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=539b7fa724",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=88c1fde3ac",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=db921e2146",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=0c05e88dc4",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://example.com/webhook.php?scan=1831618019&action=export&what=result&id=f705665d0d",
      "httpStatusCode": 200,
      "isHealthy": true
    }
  ],
  "developerPayload": ""
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = ExportCompleted::createFromJsonObject($this->sampleResponse);
        $this->assertTrue($result->completed);
        $this->assertEquals($this->sampleResponse->developerPayload, $result->developerPayload);
        $this->assertCount(count($this->sampleResponse->tasks),$result->tasks);
        $this->assertTrue($result->tasks[0]->isHealthy);
        $this->assertEquals($this->sampleResponse->tasks[2]->httpStatusCode, $result->tasks[2]->httpStatusCode);
    }
}
