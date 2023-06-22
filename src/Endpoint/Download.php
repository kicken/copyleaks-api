<?php


namespace Kicken\Copyleaks\Endpoint;


use Kicken\Copyleaks\Model\Download\ExportParameters;
use Kicken\Copyleaks\Model\Download\ReportParameters;
use Kicken\Copyleaks\Model\Download\ResultParameters;
use Kicken\Copyleaks\Model\Download\ResultResponse\ResultResponse;
use Kicken\Copyleaks\Model\Download\TextParameters;
use Kicken\Copyleaks\Model\Download\TextResponse\TextResponse;

class Download extends Endpoint {
    public function export(ExportParameters $parameters) : void{
        $url = 'v3/downloads/' . rawurlencode($parameters->scanId) . '/export/' . rawurlencode($parameters->exportId);
        $this->sendRequest('POST', $url, $parameters);
    }
}
