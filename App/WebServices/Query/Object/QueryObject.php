<?php

namespace SoapTotvs\WebServices\Query\Object;

use SoapTotvs\Enums\{
    SystemEnum,
    AffiliateEnum
};

final readonly class QueryObject
{
    public function __construct(
        public string $sentence,
        public AffiliateEnum $affiliate,
        public SystemEnum $system,
        public array $parameters
    ) {
    }
}
