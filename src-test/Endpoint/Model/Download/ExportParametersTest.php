<?php

namespace Kicken\Copyleaks\Test\Endpoint\Model\Download;

use Kicken\Copyleaks\Endpoint\Model\ExportParameters;
use Kicken\Copyleaks\Endpoint\Model\ResultParameters;
use PHPUnit\Framework\TestCase;

class ExportParametersTest extends TestCase {
    private const SCAN_ID = 'exampleScanId';
    private const EXPORT_ID = 'exampleExportId';
    private const COMPLETION_HOOK = 'https://example.com';

    public function testConstructorSetsParameters(){
        $params = $this->createParameters();
        $this->assertEquals(self::SCAN_ID, $params->scanId);
        $this->assertEquals(self::EXPORT_ID, $params->exportId);
        $this->assertEquals(self::COMPLETION_HOOK, $params->completionWebhook);
    }

    public function testAddResult(){
        $result = new ResultParameters();
        $params = $this->createParameters();
        $params->addResult($result);
        $this->assertCount(1, $params->results);
    }

    private function createParameters() : ExportParameters{
        return new ExportParameters(self::SCAN_ID, self::EXPORT_ID, self::COMPLETION_HOOK);
    }
}
