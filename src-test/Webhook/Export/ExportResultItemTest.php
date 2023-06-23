<?php

namespace Kicken\Copyleaks\Test\Webhook\Export;

use Kicken\Copyleaks\Webhook\Model\Export\ExportResultItem;
use PHPUnit\Framework\TestCase;

class ExportResultItemTest extends TestCase {
    private \stdClass $sampleResponse;

    protected function setUp() : void{
        $this->sampleResponse = json_decode(/** @lang JSON */ '{
  "statistics": {
    "identical": 1,
    "minorChanges": 2,
    "relatedMeaning": 3
  },
  "text": {
    "value": "Hello world!",
    "pages": {
      "startPosition": [
        0
      ]
    },
    "comparison": {
      "identical": {
        "source": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        }
      },
      "minorChanges": {
        "source": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        }
      },
      "relatedMeaning": {
        "source": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        }
      }
    }
  },
  "html": {
    "value": "<HTML><body><h3>Hello world!</h3></body></HTML>",
    "comparison": {
      "identical": {
        "groupId": [
          0
        ],
        "source": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        }
      },
      "minorChanges": {
        "groupId": [
          0
        ],
        "source": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        }
      },
      "relatedMeaning": {
        "groupId": [
          0
        ],
        "source": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        },
        "suspected": {
          "chars": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          },
          "words": {
            "starts": [
              0
            ],
            "lengths": [
              1
            ]
          }
        }
      }
    }
  }
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
        $this->assertEquals($this->sampleResponse->html->value, $result->html->value);
        $this->assertNull($result->html->pages);
    }
}
