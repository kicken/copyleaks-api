<?php

namespace Kicken\Copyleaks\Model\Scans;

class Scanning {
    public ?bool $internet = null;
    public ScanningExclude $exclude;
    /** @var ScanningRepository[] */
    public ?array $repositories = null;
    public CopyleaksDb $copyleaksDb;
    public CrossLanguages $crossLanguages;

    public function __construct(){
        $this->exclude = new ScanningExclude();
        $this->copyleaksDb = new CopyleaksDb();
        $this->crossLanguages = new CrossLanguages();
    }
}
