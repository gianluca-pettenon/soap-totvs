<?php

namespace SoapTotvs\Adapters;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Enums\OperationEnum;
use SoapClient;

class NativeSoapAdapter implements AdapterInterface
{
    /**
     * @var array<string, mixed>
     */
    private array $options;

    /**
     * @param array<string, mixed> $options Additional SoapClient options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    protected function createClient(WsdlEnum $wsdlEnum): SoapClient
    {
        $defaultOptions = [
            'login' => getenv('WSUSER'),
            'password' => getenv('WSPASS'),
            'soap_version' => SOAP_1_1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'keep_alive' => false,
            'connection_timeout' => 25000,
            'exceptions' => true,
        ];

        return new SoapClient(
            getenv('WSHOST') . $wsdlEnum->value, 
            array_merge($defaultOptions, $this->options)
        );
    }

    public function call(WsdlEnum $wsdlEnum, OperationEnum $operation, array $parameters): mixed
    {
        $client = $this->createClient($wsdlEnum);

        return $client->{$operation->value}(...$parameters);
    }
}
