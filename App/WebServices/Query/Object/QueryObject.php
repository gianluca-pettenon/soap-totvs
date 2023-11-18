<?php

namespace App\WebServices\Query\Object;

use App\Enums\{
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
