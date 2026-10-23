<?php

namespace SoapTotvs\Adapters;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};
use SoapClient;

class NativeSoapAdapter implements AdapterInterface
{
    public function __construct(
        private SoapConfig $config
    ) {
    }

    protected function createClient(WsdlEnum $wsdlEnum): SoapClient
    {
        return new SoapClient(
            $this->config->wsdl($wsdlEnum),
            ['exceptions' => true, ...$this->config->options()]
        );
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function call(WsdlEnum $wsdlEnum, OperationEnum $operation, array $parameters): mixed
    {
        $client = $this->createClient($wsdlEnum);

        return $client->{$operation->value}(...$parameters);
    }
}
