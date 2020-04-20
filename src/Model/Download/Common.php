<?php


namespace Kicken\Copyleaks\Model\Download;


class Common {
    /** @var string */
    public $scanId;

    public function __construct(string $scanId){
        $this->scanId = $scanId;
    }
}
