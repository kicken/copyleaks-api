<?php

namespace Kicken\Copyleaks\Test\Webhook\Scans;

use Kicken\Copyleaks\Webhook\Model\Scans\Completed;
use PHPUnit\Framework\TestCase;

class CompletedTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "status": 0,
  "developerPayload": "Custom developer payload",
  "scannedDocument": {
    "scanId": "string",
    "totalWords": 0,
    "totalExcluded": 0,
    "credits": 0,
    "creationTime": "2023-06-23 14:46:23",
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
  },
  "results": {
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
    ],
    "score": {
      "identicalWords": 0,
      "minorChangedWords": 0,
      "relatedMeaningWords": 0,
      "aggregatedScore": 0
    }
  },
  "downloadableReport": {
    "status": "Success = 0",
    "report": "string"
  },
  "notifications": {
    "alerts": [
      {
        "code": "alert-1",
        "title": "string",
        "message": "string",
        "helpLink": "string",
        "severity": 0,
        "additionalData": "string"
      }
    ]
  }
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = Completed::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->status, $result->status);
        $this->assertEquals($this->sampleResponse->developerPayload, $result->developerPayload);

        $this->assertEquals($this->sampleResponse->scannedDocument->scanId, $result->scannedDocument->scanId);
        $this->assertEquals($this->sampleResponse->scannedDocument->metadata->finalUrl, $result->scannedDocument->metadata->finalUrl);

        $this->assertCount(count($this->sampleResponse->results->internet), $result->results->internet);
        $this->assertEquals($this->sampleResponse->results->internet[0]->id, $result->results->internet[0]->id);
        $this->assertEquals($this->sampleResponse->results->internet[0]->url, $result->results->internet[0]->url);

        $this->assertCount(count($this->sampleResponse->results->batch), $result->results->batch);
        $this->assertEquals($this->sampleResponse->results->batch[0]->id, $result->results->batch[0]->id);
        $this->assertEquals($this->sampleResponse->results->batch[0]->scanId, $result->results->batch[0]->scanId);

        $this->assertCount(count($this->sampleResponse->results->database), $result->results->database);
        $this->assertEquals($this->sampleResponse->results->database[0]->id, $result->results->database[0]->id);
        $this->assertEquals($this->sampleResponse->results->database[0]->scanId, $result->results->database[0]->scanId);

        $this->assertCount(count($this->sampleResponse->results->repositories), $result->results->repositories);
        $this->assertEquals($this->sampleResponse->results->repositories[0]->id, $result->results->repositories[0]->id);
        $this->assertEquals($this->sampleResponse->results->repositories[0]->scanId, $result->results->repositories[0]->scanId);
        $this->assertEquals($this->sampleResponse->results->repositories[0]->metadata->submittedBy, $result->results->repositories[0]->metadata->submittedBy);

        $this->assertCount(count($this->sampleResponse->notifications->alerts), $result->notifications->alerts);
        $this->assertEquals($this->sampleResponse->notifications->alerts[0]->code, $result->notifications->alerts[0]->code);
    }
}
