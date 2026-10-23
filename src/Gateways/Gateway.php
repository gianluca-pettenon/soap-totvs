<?php

namespace SoapTotvs\Gateways;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};

abstract class Gateway
{
    public function __construct(
        private AdapterInterface $adapter
    ) {
    }

    abstract protected function wsdl(): WsdlEnum;

    /**
     * @param array<string, mixed> $parameters
     */
    protected function call(OperationEnum $operation, array $parameters): object
    {
        $result = $this->adapter->call($this->wsdl(), $operation, $parameters);
        assert(is_object($result));

        return $result;
    }
}
