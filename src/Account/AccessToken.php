<?php

namespace Kicken\Copyleaks\Account;

use DateTimeImmutable;

class AccessToken {
    public string $accessToken;
    public DateTimeImmutable $issued;
    public DateTimeImmutable $expires;

    public function __construct(\stdClass $data){
        $this->accessToken = $data->access_token;
        $this->issued = new DateTimeImmutable($data->{'.issued'});

        //Expire 5 minutes earlier than indicated.
        $expires = new DateTimeImmutable($data->{'.expires'});
        $this->expires = $expires->sub(new \DateInterval('PT5M'));
    }

    public function isExpired() : bool{
        return new DateTimeImmutable() >= $this->expires;
    }
}
