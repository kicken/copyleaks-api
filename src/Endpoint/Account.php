<?php


namespace Kicken\Copyleaks\Endpoint;


use Kicken\Copyleaks\Model\Account\LoginParameters;
use Kicken\Copyleaks\Model\Account\LoginResponse;

class Account extends Endpoint {
    protected function getBaseUri(){
        return 'https://id.copyleaks.com/v3/';
    }

    public function login(LoginParameters $parameters){
        $response = $this->sendRequest('POST', 'account/login/api', $parameters)->decodeJson();

        return new LoginResponse(
            $response->access_token
            , new \DateTime($response->{'.issued'})
            , new \DateTime($response->{'.expires'})
        );
    }
}
