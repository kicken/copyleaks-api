<?php

namespace Kicken\Copyleaks\Endpoint\Model\Internal;

class Exclude {
    public ?bool $quotes = null;
    public ?bool $citations = null;
    public ?bool $references = null;
    public ?bool $tableOfContents = null;
    public ?bool $titles = null;
    public ?bool $htmlTemplate = null;
    /** @var string[] */
    public ?array $documentTemplateIds = null;
}
