<?php

namespace Kicken\Copyleaks\Test\Endpoint\Model\Scans;

use Kicken\Copyleaks\Endpoint\Model\SubmitUrlParameters;
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

    private function createParameters(string $statusHook = self::STATUS_HOOK) : SubmitUrlParameters{
        return new SubmitUrlParameters(self::URL, self::SCAN_ID, $statusHook);
    }
}
