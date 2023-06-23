<?php

namespace Kicken\Copyleaks\Test\Webhook\Scans;

use Kicken\Copyleaks\Webhook\Model\Scans\NewResult;
use PHPUnit\Framework\TestCase;

class NewResultTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "score": 0,
  "developerPayload": "string",
  "internet": [
    {
      "id": "internet-0",
      "title": "string",
      "introduction": "string",
      "matchedWords": 0,
      "url": "string",
      "metadata": {
        "finalUrl": "string",
        "canonicalUrl": "string",
        "author": "string",
        "organization": "string",
        "filename": "string",
        "publishDate": "2023-06-23",
        "creationDate": "2023-06-23",
        "lastModificationDate": "2023-06-23"
      }
    }
  ],
  "database": [
    {
      "id": "database-0",
      "title": "string",
      "introduction": "string",
      "matchedWords": 0,
      "scanId": "string",
      "metadata": {
        "finalUrl": "string",
        "canonicalUrl": "string",
        "author": "string",
        "organization": "string",
        "filename": "string",
        "publishDate": "2023-06-23",
        "creationDate": "2023-06-23",
        "lastModificationDate": "2023-06-23"
      }
    }
  ],
  "batch": [
    {
      "id": "batch-0",
      "title": "string",
      "introduction": "string",
      "matchedWords": 0,
      "scanId": "string",
      "metadata": {
        "finalUrl": "string",
        "canonicalUrl": "string",
        "author": "string",
        "organization": "string",
        "filename": "string",
        "publishDate": "2023-06-23",
        "creationDate": "2023-06-23",
        "lastModificationDate": "2023-06-23"
      }
    }
  ],
  "repositories": [
    {
      "id": "repositories-0",
      "title": "string",
      "introduction": "string",
      "matchedWords": 0,
      "repositoryId": "string",
      "scanId": "string",
      "metadata": {
        "finalUrl": "string",
        "canonicalUrl": "string",
        "author": "string",
        "organization": "string",
        "filename": "string",
        "publishDate": "2023-06-23",
        "creationDate": "2023-06-23",
        "lastModificationDate": "2023-06-23",
        "submittedBy": "string"
      }
    }
  ]
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = NewResult::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->score, $result->score);
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
