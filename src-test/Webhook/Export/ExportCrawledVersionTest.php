<?php

namespace Kicken\Copyleaks\Test\Webhook\Export;

use Kicken\Copyleaks\Webhook\Model\Export\ExportCrawledVersion;
use PHPUnit\Framework\TestCase;

class ExportCrawledVersionTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "metadata": {
    "words": 3,
    "excluded": 0
  },
  "text": {
    "exclude": {
      "starts": [ ],
      "lengths": [ ],
      "reasons": [ ]
    },
    "pages": {
      "startPosition": [ 0 ]
    },
    "value": "Example document content"
  },
  "version": 3
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = ExportCrawledVersion::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->metadata->words, $result->metadata->words);

        if (isset($this->sampleResponse->html)){
            //HTML structure does not have pages, but does have group IDs
            $this->assertEquals($this->sampleResponse->html->value, $result->html->value);
            $this->assertNull($result->html->pages);
            $this->assertNotNull($result->html->exclude->groupIds);
        }

        //Text structure has pages, but does not have group IDs
        $this->assertEquals($this->sampleResponse->text->value, $result->text->value);
        $this->assertNotNull($result->text->pages);
        $this->assertNull($result->text->exclude->groupIds);
    }
}
