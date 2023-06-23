<?php


namespace Kicken\Copyleaks\Endpoint;


use Kicken\Copyleaks\Endpoint\Model\ExportParameters;

class Download extends Endpoint {
    public function export(ExportParameters $parameters) : void{
        $url = 'v3/downloads/' . rawurlencode($parameters->scanId) . '/export/' . rawurlencode($parameters->exportId);
        $this->sendRequest('POST', $url, $parameters);
    }
}
