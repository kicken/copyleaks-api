<?php

namespace Kicken\Copyleaks\Test\Endpoint\Model\Scans;

use Kicken\Copyleaks\Endpoint\Model\SubmitUrlParameters;
use Kicken\Copyleaks\Model\ModelSerializer;
use PHPUnit\Framework\TestCase;

class SubmitUrlParametersTest extends TestCase {
    private const URL = 'https://example.com';
    private const SCAN_ID = 'example';
    private const STATUS_HOOK = 'https://example.com/{STATUS}';

    public function testConstructorSetsProperties(){
        $params = $this->createParameters();
        $this->assertEquals(self::URL, $params->url);
        $this->assertEquals(self::SCAN_ID, $params->scanId);
        $this->assertEquals(self::STATUS_HOOK, $params->properties->webhooks->status);
    }

    public function testStatusHookRequiresPlaceholder(){
        $this->expectException(\InvalidArgumentException::class);
        $this->createParameters('https://example.com/');
    }

    public function testStatusHookPlaceholderIsCaseSensitive(){
        $this->expectException(\InvalidArgumentException::class);
        $this->createParameters('https://example.com/{status}');
    }

    public function testSerializesUrlProperly(){
        $params = $this->createParameters();
        $serializer = new ModelSerializer();

        $json = $serializer->serialize($params);
        $expectedJson = json_encode([
            'url' => self::URL,
            'properties' => [
                'webhooks' => [
                    'status' => $params->properties->webhooks->status
                ]
            ]
        ]);
        $this->assertEquals($expectedJson, $json);
    }

    private function createParameters(string $statusHook = self::STATUS_HOOK) : SubmitUrlParameters{
        return new SubmitUrlParameters(self::URL, self::SCAN_ID, $statusHook);
    }
}
