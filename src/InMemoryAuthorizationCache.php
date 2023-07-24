<?php

namespace Kicken\Copyleaks;

use Kicken\Copyleaks\Account\AccessToken;

class InMemoryAuthorizationCache implements AuthorizationCache {
    private ?AccessToken $token = null;

    public function getToken() : ?AccessToken{
        return $this->token;
    }

    public function updateToken(AccessToken $token) : void{
        $this->token = $token;
    }
}
