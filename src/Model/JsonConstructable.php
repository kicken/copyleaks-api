<?php


namespace Kicken\Copyleaks\Model;


interface JsonConstructable {
    /**
     * Construct a new instance from data in a json object.
     *
     * @param \stdClass $json
     *
     * @return self
     */
    public static function createFromJsonObject(\stdClass $json);
}
