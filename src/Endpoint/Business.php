<?php


namespace Kicken\Copyleaks\Endpoint;


use Kicken\Copyleaks\Model\Businesses\SubmitFileParameters;
use Kicken\Copyleaks\Model\Businesses\SubmitOCRParameters;
use Kicken\Copyleaks\Model\Businesses\SubmitUrlParameters;
use Kicken\Copyleaks\NotImplementedException;

class Business extends Endpoint {
    private $sandboxMode = false;

    protected function getBaseUri(){
        return 'https://api.copyleaks.com/v3/';
    }

    public function enableSandboxMode(){
        $this->sandboxMode = true;

        return $this;
    }

    public function submitURL(SubmitUrlParameters $parameters){
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'businesses/submit/url/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function submitFile(SubmitFileParameters $parameters){
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'businesses/submit/file/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function submitOCR(SubmitOCRParameters $parameters){
        if ($this->sandboxMode){
            $parameters->properties['sandbox'] = true;
        }

        $url = 'businesses/submit/ocr/' . rawurlencode($parameters->scanId);
        $this->sendRequest('PUT', $url, $parameters);
    }

    public function start(){
        throw new NotImplementedException();
    }

    public function batchStart(){
        throw new NotImplementedException();
    }

    public function delete(){
        throw new NotImplementedException();
    }

    public function resendHooks(){
        throw new NotImplementedException();
    }

    public function credits(){
        throw new NotImplementedException();
    }

    public function usageHistory(){
        throw new NotImplementedException();
    }
}
