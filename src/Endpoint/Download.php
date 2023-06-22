<?php


namespace Kicken\Copyleaks\Endpoint;


use Kicken\Copyleaks\Model\Download\ExportParameters;
use Kicken\Copyleaks\Model\Download\ReportParameters;
use Kicken\Copyleaks\Model\Download\ResultParameters;
use Kicken\Copyleaks\Model\Download\ResultResponse\ResultResponse;
use Kicken\Copyleaks\Model\Download\TextParameters;
use Kicken\Copyleaks\Model\Download\TextResponse\TextResponse;

class Download extends Endpoint {
    public function getBaseUri() : string{
        return 'https://api.copyleaks.com/v3/';
    }

    public function text(TextParameters $parameters) : TextResponse{
        $url = 'downloads/' . rawurlencode($parameters->scanId);
        $rawData = $this->sendRequest('GET', $url, $parameters)->decodeJson();

        return TextResponse::createFromJsonObject($rawData);
    }

    public function result(ResultParameters $parameters) : ResultResponse{
        $url = 'downloads/' . rawurlencode($parameters->scanId) . '/results/' . rawurlencode($parameters->resultId);
        $json = $this->sendRequest('GET', $url, $parameters)->decodeJson();

        return ResultResponse::createFromJsonObject($json);
    }

    public function report(ReportParameters $parameters) : string{
        $url = 'downloads/' . rawurlencode($parameters->scanId) . '/report.pdf';

        return $this->sendRequest('GET', $url)->bodyContent();
    }

    public function export(ExportParameters $parameters) : void{
        $url = 'downloads/' . rawurlencode($parameters->scanId) . '/export/' . rawurlencode($parameters->exportId);
        $this->sendRequest('POST', $url, $parameters);
    }
}
