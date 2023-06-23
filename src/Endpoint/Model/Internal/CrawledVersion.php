<?php

namespace Kicken\Copyleaks\Endpoint\Model\Internal;

class CrawledVersion {
    public ?string $endpoint = null;
    public ?string $verb = null;
    /** @var string[] */
    public ?array $headers = null;
}
