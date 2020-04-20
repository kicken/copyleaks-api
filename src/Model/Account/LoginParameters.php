<?php


namespace Kicken\Copyleaks\Model\Account;


class LoginParameters {
    /** @var string */
    public $email;
    /** @var string */
    public $key;

    public function __construct(string $email, string $apiKey){
        $this->email = $email;
        $this->key = $apiKey;
    }
}
