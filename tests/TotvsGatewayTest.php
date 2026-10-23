<?php

declare(strict_types=1);

namespace SoapTotvs\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};
use SoapTotvs\Gateways\{DataServerGateway, ProcessGateway, QueryGateway};
use SoapTotvs\TotvsGateway;

final class TotvsGatewayTest extends TestCase
{
    #[Test]
    public function queryGatewayIsReturned(): void
    {
        $gateway = new TotvsGateway(
            adapter: new DummyAdapter()
        );

        $this->assertInstanceOf(QueryGateway::class, $gateway->query());
    }

    #[Test]
    public function processGatewayIsReturned(): void
    {
        $gateway = new TotvsGateway(
            adapter: new DummyAdapter()
        );

        $this->assertInstanceOf(ProcessGateway::class, $gateway->process());
    }

    #[Test]
    public function dataServerGatewayIsReturned(): void
    {
        $gateway = new TotvsGateway(
            adapter: new DummyAdapter()
        );

        $this->assertInstanceOf(DataServerGateway::class, $gateway->dataServer());
    }
}

final class DummyAdapter implements AdapterInterface
{
    public function call(WsdlEnum $wsdlEnum, OperationEnum $operation, array $parameters): mixed
    {
        return null;
    }
}
