<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Gateways;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\AffiliateEnum;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\SystemEnum;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Gateways\QueryGateway;

final class QueryGatewayTest extends TestCase
{
    public function testExecuteCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::QUERY,
                OperationEnum::REALIZE_SQL_QUERY,
                [
                    'codSentenca' => 'QUERY.TEST',
                    'codColigada' => AffiliateEnum::DEFAULT->value,
                    'codSistema' => SystemEnum::EDUCATIONAL->value,
                    'parameters' => ['p1' => 'v1']
                ]
            )
            ->willReturn((object) ['result' => 'query_result']);

        $gateway = new QueryGateway($adapter);
        $result = $gateway->execute(
            sentence: 'QUERY.TEST',
            affiliate: AffiliateEnum::DEFAULT,
            system: SystemEnum::EDUCATIONAL,
            parameters: ['p1' => 'v1']
        );

        $this->assertEquals((object) ['result' => 'query_result'], $result);
    }
}
