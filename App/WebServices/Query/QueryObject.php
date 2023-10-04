<?php

namespace App\WebServices\Query;

final class QueryObject
{
    public function __construct(
        public readonly string $sentence,
        public readonly int|string $affiliate,
        public readonly string $system,
        public readonly array $parameters
    ) {
    }
}