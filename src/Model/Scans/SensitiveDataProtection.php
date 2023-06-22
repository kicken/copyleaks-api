<?php

namespace Kicken\Copyleaks\Model\Scans;

class SensitiveDataProtection {
    public ?bool $driversLicense = null;
    public ?bool $credentials = null;
    public ?bool $passport = null;
    public ?bool $network = null;
    public ?bool $url = null;
    public ?bool $emailAddress = null;
    public ?bool $creditCard = null;
    public ?bool $phoneNumber = null;
}
