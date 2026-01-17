<?php

namespace SoapTotvs\Gateways;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\WebServices\Process\Object\ProcessObject;
use SoapTotvs\WebServices\Process\Process;

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
        $processWebService = new Process(
            adapterInterface: $this->adapter,
            processObject: new ProcessObject(
                process: $process,
                xml: $xml
            )
        );

        return $processWebService->execute();
    }
}

