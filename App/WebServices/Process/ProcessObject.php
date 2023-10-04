<?php

namespace App\WebServices\Process;

final class ProcessObject
{
    public function __construct(
        public readonly string $process,
        public readonly string $xml
    ) {
    }
}