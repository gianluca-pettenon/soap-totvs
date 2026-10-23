<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+Process
 **/

namespace SoapTotvs\Gateways;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};

final class ProcessGateway
{
    public function __construct(
        private AdapterInterface $adapter
    ) {
    }

    public function execute(
        string $process,
        string $xml
    ): int {
        return (int) $this->adapter->call(
            WsdlEnum::PROCESS,
            OperationEnum::EXECUTE_WITH_XML_PARAMS,
            [
                'ProcessServerName' => $process,
                'strXmlParams' => $xml,
            ]
        );
    }
}
