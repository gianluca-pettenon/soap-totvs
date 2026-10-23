<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Gateways;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};
use SoapTotvs\Gateways\QueryGateway;

final class QueryGatewayTest extends TestCase
{
    #[Test]
    public function executeCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::QUERY,
                OperationEnum::REALIZE_SQL_QUERY,
                [
                    'codSentenca' => 'QUERY.TEST',
                    'codColigada' => 1,
                    'codSistema' => 'S',
                    'parameters' => ['p1' => 'v1']
                ]
            )
            ->willReturn((object) ['result' => 'query_result']);

        $gateway = new QueryGateway($adapter);
        $result = $gateway->execute(
            sentence: 'QUERY.TEST',
            affiliate: 1,
            system: 'S',
            parameters: ['p1' => 'v1']
        );

        $this->assertEquals((object) ['result' => 'query_result'], $result);
    }
}
