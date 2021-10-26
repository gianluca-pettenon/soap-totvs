<?php

namespace App\Libraries;

class Response
{
    public static function set($response)
    {
        if (!headers_sent()) :
            header('Content-Type: application/json');
        endif;

        exit(json_encode($response));
    }
}