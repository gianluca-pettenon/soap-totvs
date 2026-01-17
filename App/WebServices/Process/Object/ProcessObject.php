<?php

namespace SoapTotvs\WebServices\Process\Object;

final readonly class ProcessObject
{
    public function __construct(
        public string $process,
        public string $xml
    ) {
    }
}
