<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+Process
 **/

namespace App\WebServices\Process;

use App\Adapters\Contracts\AdapterInterface;
use App\WebServices\Process\ProcessObject;

class Process
{
    public function __construct(
        private AdapterInterface $adapterInterface,
        private ProcessObject $processObject
    ) {
        $adapterInterface->getAdapter('/wsProcess/MEX?wsdl');
    }

    public function execute(): int
    {
        return $this->adapterInterface->ExecuteWithXmlParams(
            [
                'ProcessServerName' => $this->processObject->process,
                'strXmlParams'      => $this->processObject->xml
            ]
        );
    }
}
