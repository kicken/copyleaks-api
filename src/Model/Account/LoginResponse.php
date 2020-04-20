<?php


namespace Kicken\Copyleaks\Model\Account;


use DateTime;

class LoginResponse {
    public $accessToken;
    public $issued;
    public $expires;

    public function __construct(string $accessToken, DateTime $issued, DateTime $expires){
        $this->accessToken = $accessToken;
        $this->issued = $issued;
        $this->expires = $expires;
    }
}
