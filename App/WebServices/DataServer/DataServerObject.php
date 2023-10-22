<?php

namespace App\WebServices\DataServer;

final class DataServerObject
{
    public function __construct(
        public readonly string $dataServer,
        public readonly ?string $context,
        public readonly ?string $xml,
        public readonly ?int $primaryKey,
        public readonly string $filter
    ) {
    }
}