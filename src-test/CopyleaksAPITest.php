<?php

namespace Kicken\Copyleaks\Test;

use Kicken\Copyleaks\CopyleaksAPI;
use Kicken\Copyleaks\Endpoint\Download;
use Kicken\Copyleaks\Endpoint\Scans;
use PHPUnit\Framework\TestCase;

class CopyleaksAPITest extends TestCase {
    public function testScansEndpoint(){
        $client = new CopyleaksAPI('test', 'test');
        $this->assertInstanceOf(Scans::class, $client->scans());
    }

    public function testDownloadsEndpoint(){
        $client = new CopyleaksAPI('test', 'test');
        $this->assertInstanceOf(Download::class, $client->downloads());
    }
}
