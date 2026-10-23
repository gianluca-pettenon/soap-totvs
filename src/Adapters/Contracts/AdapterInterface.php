<?php

namespace SoapTotvs\Adapters\Contracts;

use SoapTotvs\Enums\{OperationEnum, WsdlEnum};

interface AdapterInterface
{
    /**
     * @param array<string, mixed> $parameters
     */
    public function call(WsdlEnum $wsdlEnum, OperationEnum $operation, array $parameters): mixed;
}
