<?php

namespace App\WebServices\Query\Object;

use App\Enums\SystemEnum;

final readonly class QueryObject
{
    public function __construct(
        public string $sentence,
        public int|string $affiliate,
        public SystemEnum $system,
        public array $parameters
    ) {
    }
}
