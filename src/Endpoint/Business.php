<?php


namespace Kicken\Copyleaks\Endpoint;


use Kicken\Copyleaks\Model\Businesses\SubmitFileParameters;
use Kicken\Copyleaks\Model\Businesses\SubmitOCRParameters;
use Kicken\Copyleaks\Model\Businesses\SubmitUrlParameters;
use Kicken\Copyleaks\NotImplementedException;

class Business extends Endpoint {
    private bool $sandboxMode = false;

    protected function getBaseUri() : string{
        return 'https://api.copyleaks.com/v3/';
    }

    public function enableSandboxMode() : Business{
        $this->sandboxMode = true;

        return $this;
    }

    public function submitURL(SubmitUrlParameters $parameters) : void{
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'businesses/submit/url/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function submitFile(SubmitFileParameters $parameters) : void{
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'businesses/submit/file/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function submitOCR(SubmitOCRParameters $parameters) : void{
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'businesses/submit/ocr/' . rawurlencode($parameters->scanId);
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

    public function credits() : void{
        throw new NotImplementedException();
    }

    public function usageHistory() : void{
        throw new NotImplementedException();
    }
}
