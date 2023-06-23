<?php

namespace Kicken\Copyleaks\Test\Webhook\Export;

use Kicken\Copyleaks\Webhook\Model\Export\ExportResultItem;
use PHPUnit\Framework\TestCase;

class ExportResultItemTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "statistics": {
    "identical": 25,
    "minorChanges": 0,
    "relatedMeaning": 0
  },
  "text": {
    "comparison": {
      "identical": {
        "source": {
          "chars": {
            "starts": [ 2564 ],
            "lengths": [ 167 ]
          },
          "words": {
            "starts": [ 392 ],
            "lengths": [ 24 ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [ 2611 ],
            "lengths": [ 167 ]
          },
          "words": {
            "starts": [ 192 ],
            "lengths": [ 24 ]
          }
        }
      },
      "minorChanges": {
        "source": {
          "chars": {
            "starts": [ ],
            "lengths": [ ]
          },
          "words": {
            "starts": [ ],
            "lengths": [ ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [ ],
            "lengths": [ ]
          },
          "words": {
            "starts": [ ],
            "lengths": [ ]
          }
        }
      },
      "relatedMeaning": {
        "source": {
          "chars": {
            "starts": [ ],
            "lengths": [ ]
          },
          "words": {
            "starts": [ ],
            "lengths": [ ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [ ],
            "lengths": [ ]
          },
          "words": {
            "starts": [ ],
            "lengths": [ ]
          }
        }
      }
    },
    "value": "Some example data",
    "pages": {
      "startPosition": [ 0, 4996 ]
    }
  },
  "html": { },
  "version": 3
}');
    }

    public function testResponseIsParsedSuccessfully(){
        $result = ExportResultItem::createFromJsonObject($this->sampleResponse);
        $this->assertEquals($this->sampleResponse->statistics->identical, $result->statistics->identical);
        $this->assertEquals($this->sampleResponse->statistics->minorChanges, $result->statistics->minorChanges);
        $this->assertEquals($this->sampleResponse->statistics->relatedMeaning, $result->statistics->relatedMeaning);
        //Text has pages
        $this->assertEquals($this->sampleResponse->text->value, $result->text->value);
        $this->assertNotNull($result->text->pages);

        //HTML does not have pages.
        if (isset($this->sampleResponse->html->value)){
            $this->assertEquals($this->sampleResponse->html->value, $result->html->value);
        }
        $this->assertNull($result->html->pages);
    }
}
