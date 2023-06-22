<?php


namespace Kicken\Copyleaks\Model\Download;


class Common {
    /** @var string */
    public string $scanId;

    public function __construct(string $scanId){
        $this->scanId = $scanId;
    }
}
