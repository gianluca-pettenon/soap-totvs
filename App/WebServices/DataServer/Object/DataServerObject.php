<?php

namespace SoapTotvs\WebServices\DataServer\Object;

use SoapTotvs\Enums\ContextEnum;

final readonly class DataServerObject
{
    public function __construct(
        public string $dataServer,
        public ContextEnum $context,
        public ?string $xml,
        public ?int $primaryKey,
        public string $filter
    ) {
    }
}
