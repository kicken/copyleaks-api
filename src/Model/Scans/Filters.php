<?php

namespace Kicken\Copyleaks\Model\Scans;

class Filters {
    public ?bool $identicalEnabled = null;
    public ?bool $minorChangesEnabled = null;
    public ?bool $relatedMeaningEnabled = null;
    public ?int $minCopiedWords = null;
    public ?bool $safeSearch = null;
    public ?bool $domains = null;
    public ?int $domainsMode = null;
}
