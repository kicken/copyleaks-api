<?php

namespace Kicken\Copyleaks\Test\Model\Webhook\Export;

use Kicken\Copyleaks\Model\Webhook\Export\ExportCompleted;
use PHPUnit\Framework\TestCase;

class ExportCompletedTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "completed": true,
  "developerPayload": "This is my payload",
  "tasks": [
    {
      "endpoint": "https://yourserver.com/export/export-id/results/my-result-id",
      "httpStatusCode": 200,
      "isHealthy": true
    },
    {
      "endpoint": "https://yourserver.com/export/export-id/pdf-report",
      "httpStatusCode": 500,
      "isHealthy": false
    },
    {
      "endpoint": "https://yourserver.com/export/export-id/crawled-version",
      "httpStatusCode": 200,
      "isHealthy": true
    }
  ]
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = ExportCompleted::createFromJsonObject($this->sampleResponse);
        $this->assertTrue($result->completed);
        $this->assertEquals($this->sampleResponse->developerPayload, $result->developerPayload);
        $this->assertCount(count($this->sampleResponse->tasks),$result->tasks);
        $this->assertTrue($result->tasks[0]->isHealthy);
        $this->assertFalse($result->tasks[1]->isHealthy);
    }
}
