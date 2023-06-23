<?php

namespace Kicken\Copyleaks\Test\Endpoint\Model\Scans;

use Kicken\Copyleaks\Endpoint\Model\SubmitOCRParameters;
use PHPUnit\Framework\TestCase;

class SubmitOCRParametersTest extends TestCase {
    private const CONTENT = 'example file content';
    private const FILENAME = 'https://example.com';
    private const LANG_CODE = 'en';
    private const SCAN_ID = 'example';
    private const STATUS_HOOK = 'https://example.com/{STATUS}';

    public function testConstructorSetsProperties(){
        $params = $this->createParameters();
        $this->assertEquals(self::CONTENT, $params->base64);
        $this->assertEquals(self::FILENAME, $params->filename);
        $this->assertEquals(self::LANG_CODE, $params->langCode);
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

    private function createParameters(string $statusHook = self::STATUS_HOOK) : SubmitOCRParameters{
        return new SubmitOCRParameters(self::CONTENT, self::FILENAME, self::LANG_CODE, self::SCAN_ID, $statusHook);
    }
}
