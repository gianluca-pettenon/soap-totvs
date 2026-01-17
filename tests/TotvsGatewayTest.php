<?php

declare(strict_types=1);

namespace SoapTotvs\Tests;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Gateways\DataServerGateway;
use SoapTotvs\Gateways\ProcessGateway;
use SoapTotvs\Gateways\QueryGateway;
use SoapTotvs\TotvsGateway;

final class TotvsGatewayTest extends TestCase
{
    public function testQueryGatewayIsReturned(): void
    {
        $gateway = new TotvsGateway(
            adapter: new DummyAdapter()
        );

        $this->assertInstanceOf(QueryGateway::class, $gateway->query());
    }

    public function testProcessGatewayIsReturned(): void
    {
        $gateway = new TotvsGateway(
            adapter: new DummyAdapter()
        );

        $this->assertInstanceOf(ProcessGateway::class, $gateway->process());
    }

    public function testDataServerGatewayIsReturned(): void
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

