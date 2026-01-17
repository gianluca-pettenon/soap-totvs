<?php

namespace SoapTotvs\Gateways;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\AffiliateEnum;
use SoapTotvs\Enums\SystemEnum;
use SoapTotvs\WebServices\Query\Object\QueryObject;
use SoapTotvs\WebServices\Query\Query;

final class QueryGateway
{
    public function __construct(
        private AdapterInterface $adapter
    ) {
    }

    public function execute(
        string $sentence,
        AffiliateEnum $affiliate,
        SystemEnum $system,
        array $parameters
    ): object {
        $query = new Query(
            adapterInterface: $this->adapter,
            queryObject: new QueryObject(
                sentence: $sentence,
                affiliate: $affiliate,
                system: $system,
                parameters: $parameters
            )
        );

        return $query->execute();
    }
}

