<?php

namespace Kicken\Copyleaks\Test\Webhook\Scans;

use Kicken\Copyleaks\Webhook\Model\Scans\NewResult;
use PHPUnit\Framework\TestCase;

class NewResultTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "score": {
    "aggregatedScore": 41.5
  },
  "developerPayload": "",
  "internet": [
    {
      "url": "https://example.com/",
      "id": "internet-0",
      "title": "Example",
      "introduction": "Example",
      "matchedWords": 16,
      "identicalWords": 16,
      "similarWords": 0,
      "paraphrasedWords": 0,
      "totalWords": 737,
      "metadata": {
        "filename": "source"
      },
      "tags": []
    }
  ],
  "database": [
    {
      "id": "database-0",
      "title": "Example",
      "introduction": "Example",
      "scanId": "string",
      "matchedWords": 16,
      "identicalWords": 16,
      "similarWords": 0,
      "paraphrasedWords": 0,
      "totalWords": 737,
      "metadata": {
        "filename": "source"
      },
      "tags": []
    }
  ],
  "batch": [
    {
      "id": "batch-0",
      "title": "Example",
      "introduction": "Example",
      "scanId": "string",
      "matchedWords": 16,
      "identicalWords": 16,
      "similarWords": 0,
      "paraphrasedWords": 0,
      "totalWords": 737,
      "metadata": {
        "filename": "source"
      },
      "tags": [ ]
    }
  ],
  "repositories": [
    {
      "id": "repositories-0",
      "title": "Example",
      "introduction": "Example",
      "repositoryId": "12345",
      "scanId": "string",
      "matchedWords": 16,
      "identicalWords": 16,
      "similarWords": 0,
      "paraphrasedWords": 0,
      "totalWords": 737,
      "metadata": {
        "filename": "source"
      },
      "tags": []
    }
  ]
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = NewResult::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->score->aggregatedScore, $result->score->aggregatedScore);
        $this->assertEquals($this->sampleResponse->developerPayload, $result->developerPayload);
        $this->assertCount(count($this->sampleResponse->internet), $result->internet);
        $this->assertEquals($this->sampleResponse->internet[0]->id, $result->internet[0]->id);

        $this->assertCount(count($this->sampleResponse->database), $result->database);
        $this->assertEquals($this->sampleResponse->database[0]->id, $result->database[0]->id);

        $this->assertCount(count($this->sampleResponse->batch), $result->batch);
        $this->assertEquals($this->sampleResponse->batch[0]->id, $result->batch[0]->id);

        $this->assertCount(count($this->sampleResponse->repositories), $result->repositories);
        $this->assertEquals($this->sampleResponse->repositories[0]->id, $result->repositories[0]->id);
    }
}
