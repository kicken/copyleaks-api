<?php

namespace Kicken\Copyleaks\Test\Model\Webhook\Export;

use Kicken\Copyleaks\Model\Webhook\Export\ExportCrawledVersion;
use PHPUnit\Framework\TestCase;

class ExportCrawledVersionTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "metadata": {
    "words": 30,
    "excluded": 2
  },
  "html": {
    "value": "<html><body><h1>Example Domain</h1><p>This domain is established to be used for illustrative examples in documents.</body></html>",
    "exclude": {
      "starts": [
        16
      ],
      "lengths": [
        14
      ],
      "reasons": [
        3
      ],
      "groupIds": [
        1
      ]
    }
  },
  "text": {
    "value": "Example Domain This domain is established to be used for illustrative examples in documents.",
    "exclude": {
      "starts": [
        0
      ],
      "lengths": [
        14
      ],
      "reasons": [
        3
      ]
    },
    "pages": {
      "startPosition": [
        0
      ]
    }
  }
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = ExportCrawledVersion::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->metadata->words, $result->metadata->words);

        //HTML structure does not have pages, but does have group IDs
        $this->assertEquals($this->sampleResponse->html->value, $result->html->value);
        $this->assertNull($result->html->pages);
        $this->assertNotNull($result->html->exclude->groupIds);

        //Text structure has pages, but does not have group IDs
        $this->assertEquals($this->sampleResponse->text->value, $result->text->value);
        $this->assertNotNull($result->text->pages);
        $this->assertNull($result->text->exclude->groupIds);
    }
}
