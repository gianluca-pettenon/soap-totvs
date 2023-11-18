<?php

namespace App\Adapters;

use App\Adapters\Contracts\AdapterInterface;
use App\Enums\WsdlEnum;
use Laminas\Soap\Client;

class LaminasAdapter implements AdapterInterface
{
    /**
     * @param WsdlEnum $wsdlEnum
     * @return Client
     */
    public function getAdapter(WsdlEnum $wsdlEnum): Client
    {
        return new Client(getenv('WSHOST') . $wsdlEnum->value, [
            'login' => getenv('WSUSER'),
            'password' => getenv('WSPASS'),
            'soap_version' => SOAP_1_1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'keep_alive' => false,
            'connection_timeout' => 25000
        ]);
    }

}
