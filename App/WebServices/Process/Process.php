<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+Process
 **/

namespace SoapTotvs\WebServices\Process;

use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\WebServices\Process\Object\ProcessObject;

class Process
{
    public function __construct(
        private AdapterInterface $adapterInterface,
        private ProcessObject $processObject
    ) {
    }

    public function execute(): int
    {
        return (int) $this->adapterInterface->call(
            WsdlEnum::PROCESS,
            OperationEnum::EXECUTE_WITH_XML_PARAMS,
            [
                'ProcessServerName' => $this->processObject->process,
                'strXmlParams' => $this->processObject->xml
            ]
        );
    }
    
}
