<?php


namespace Kicken\Copyleaks;


class NotImplementedException extends \LogicException {
    public function __construct(){
        parent::__construct('API Method is not yet implemented.');
    }
}
