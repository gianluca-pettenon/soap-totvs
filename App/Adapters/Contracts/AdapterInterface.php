<?php

namespace SoapTotvs\Adapters\Contracts;

use SoapTotvs\Enums\WsdlEnum;

interface AdapterInterface
{
    public function call(WsdlEnum $wsdlEnum, string $operation, array $parameters): mixed;
}
