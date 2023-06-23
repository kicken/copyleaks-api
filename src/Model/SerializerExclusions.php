<?php

namespace Kicken\Copyleaks\Model;

interface SerializerExclusions {
    public function getExcludedPropertyNames() : array;
}
