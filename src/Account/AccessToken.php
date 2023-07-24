<?php

namespace Kicken\Copyleaks\Account;

use DateTimeImmutable;

class AccessToken implements \JsonSerializable {
    public string $accessToken;
    public DateTimeImmutable $issued;
    public DateTimeImmutable $expires;

    public function __construct(\stdClass $data){
        $this->accessToken = $data->access_token;
        $this->issued = new DateTimeImmutable($data->{'.issued'});
        $this->expires = new DateTimeImmutable($data->{'.expires'});
    }

    public function isExpired() : bool{
        //Expire 5 minutes earlier than indicated.
        $expires = $this->expires->sub(new \DateInterval('PT5M'));

        return new DateTimeImmutable() >= $expires;
    }

    public function jsonSerialize() : array{
        return [
            'access_token' => $this->accessToken,
            '.issued' => $this->issued->format('Y-m-d H:i:s'),
            '.expires' => $this->expires->format('Y-m-d H:i:s')
        ];
    }
}
