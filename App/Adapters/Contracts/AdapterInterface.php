<?php

namespace SoapTotvs\Adapters\Contracts;

use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Enums\OperationEnum;

interface AdapterInterface
{
    public function call(WsdlEnum $wsdlEnum, OperationEnum $operation, array $parameters): mixed;
}
