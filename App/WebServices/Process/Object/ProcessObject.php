<?php

namespace App\WebServices\Process\Object;

final readonly class ProcessObject
{
    public function __construct(
        public string $process,
        public string $xml
    ) {
    }
}
