<?php


namespace Kicken\Copyleaks\Endpoint;


use Kicken\Copyleaks\Model\Education\SubmitFileParameters;
use Kicken\Copyleaks\Model\Education\SubmitOCRParameters;
use Kicken\Copyleaks\Model\Education\SubmitUrlParameters;
use Kicken\Copyleaks\NotImplementedException;

class Education extends Endpoint {
    private bool $sandboxMode = false;

    protected function getBaseUri() : string{
        return 'https://api.copyleaks.com/v3/';
    }

    public function enableSandboxMode() : Education{
        $this->sandboxMode = true;

        return $this;
    }

    public function submitURL(SubmitUrlParameters $parameters) : void{
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'education/submit/url/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function submitFile(SubmitFileParameters $parameters) : void{
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'education/submit/file/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function submitOCR(SubmitOCRParameters $parameters) : void{
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'education/submit/ocr/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function start() : void{
        throw new NotImplementedException();
    }

    public function batchStart() : void{
        throw new NotImplementedException();
    }

    public function delete() : void{
        throw new NotImplementedException();
    }

    public function resendHooks() : void{
        throw new NotImplementedException();
    }

    public function credits() : \stdClass{
        $response = $this->sendRequest('GET', 'scans/credits');

        return $response->decodeJson();
    }

    public function usageHistory() : void{
        throw new NotImplementedException();
    }
}
