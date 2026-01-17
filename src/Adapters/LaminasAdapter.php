<?php

namespace SoapTotvs\Adapters;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Enums\OperationEnum;
use Laminas\Soap\Client;

class LaminasAdapter implements AdapterInterface
{
    private function createClient(WsdlEnum $wsdlEnum): Client
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

    public function call(WsdlEnum $wsdlEnum, OperationEnum $operation, array $parameters): mixed
    {
        $client = $this->createClient($wsdlEnum);

        return $client->call($operation->value, $parameters);
    }

}

