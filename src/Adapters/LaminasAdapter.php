<?php

namespace SoapTotvs\Adapters;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};
use Laminas\Soap\Client;

class LaminasAdapter implements AdapterInterface
{
    public function __construct(
        private SoapConfig $config
    ) {
    }

    protected function createClient(WsdlEnum $wsdlEnum): Client
    {
        return new Client($this->config->wsdl($wsdlEnum), $this->config->options());
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function call(WsdlEnum $wsdlEnum, OperationEnum $operation, array $parameters): mixed
    {
        $client = $this->createClient($wsdlEnum);

        return $client->call($operation->value, $parameters);
    }
}
