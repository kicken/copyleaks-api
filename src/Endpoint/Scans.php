<?php

namespace Kicken\Copyleaks\Endpoint;

use Kicken\Copyleaks\Model\Scans\SubmitFileParameters;
use Kicken\Copyleaks\Model\Scans\SubmitOCRParameters;
use Kicken\Copyleaks\Model\Scans\SubmitUrlParameters;

class Scans extends Endpoint {
    public function submitURL(SubmitUrlParameters $parameters) : void{
        $parameters->properties->sandbox = $this->sandboxMode;

        $url = 'v3/scans/submit/url/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function submitFile(SubmitFileParameters $parameters) : void{
        $parameters->properties->sandbox = $this->sandboxMode;

        $url = 'v3/scans/submit/file/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function submitOCR(SubmitOCRParameters $parameters) : void{
        $parameters->properties->sandbox = $this->sandboxMode;

        $url = 'v3/scans/submit/ocr/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function credits() : int{
        $response = $this->sendRequest('GET', 'v3/scans/credits');
        $result = $response->decodeJson();

        return $result->Amount;
    }
}
