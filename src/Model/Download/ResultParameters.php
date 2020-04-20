<?php


namespace Kicken\Copyleaks\Model\Download;


class ResultParameters extends Common {
    /** @var string */
    public $resultId;

    public function __construct(string $resultId, string $scanId){
        parent::__construct($scanId);
        $this->resultId = $resultId;
    }
}
