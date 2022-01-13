<?php

namespace App\Utils;

class Serialize
{
    /**
     * @param mixed $response
     * @return array
     */

    public static function result($response): array
    {
        return json_decode(json_encode(simplexml_load_string($response)), true);
    }
}
