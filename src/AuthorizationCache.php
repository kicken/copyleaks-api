<?php

namespace Kicken\Copyleaks;

use Kicken\Copyleaks\Account\AccessToken;

interface AuthorizationCache {
    public function getToken() : ?AccessToken;

    public function updateToken(AccessToken $token);
}
