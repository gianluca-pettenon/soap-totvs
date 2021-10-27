<?php

namespace App\Connection;

use Laminas\Soap\Client;

class WebService
{
    private const hostName = "http://localhost:8051";
    private const userName = "rm";
    private const passWord = "rm";

    public function getClient(string $path) : Client
    {
        try {

            $connection = new Client(self::hostName . $path, [
                'soap_version'          =>          SOAP_1_1,
                'cache_wsdl'            =>          WSDL_CACHE_NONE,
                'keep_alive'            =>          false,
                'connection_timeout'    =>          500000,
                'login'                 =>          self::userName,
                'password'              =>          self::passWord,
            ]);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $connection;
    }
}
