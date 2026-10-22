<?php

namespace SoapTotvs;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Gateways\{DataServerGateway, ProcessGateway, QueryGateway};

final class TotvsGateway
{
    public function __construct(
        private AdapterInterface $adapter
    ) {
    }

    public function query(): QueryGateway
    {
        return new QueryGateway($this->adapter);
    }

    public function process(): ProcessGateway
    {
        return new ProcessGateway($this->adapter);
    }

    public function dataServer(): DataServerGateway
    {
        return new DataServerGateway($this->adapter);
    }
}

