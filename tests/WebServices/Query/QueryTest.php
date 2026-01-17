<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\WebServices\Query;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\AffiliateEnum;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\SystemEnum;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\WebServices\Query\Object\QueryObject;
use SoapTotvs\WebServices\Query\Query;

final class QueryTest extends TestCase
{
    public function testExecuteCallsAdapterWithCorrectParameters(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $queryObject = new QueryObject(
            sentence: 'SENTENCE.CODE',
            affiliate: AffiliateEnum::DEFAULT,
            system: SystemEnum::EDUCATIONAL,
            parameters: ['param1' => 'value1']
        );

        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::QUERY,
                OperationEnum::REALIZE_SQL_QUERY,
                [
                    'codSentenca' => 'SENTENCE.CODE',
                    'codColigada' => AffiliateEnum::DEFAULT->value,
                    'codSistema' => SystemEnum::EDUCATIONAL->value,
                    'parameters' => ['param1' => 'value1']
                ]
            )
            ->willReturn((object) ['Resultado' => 'success']);

        $query = new Query($adapter, $queryObject);
        $result = $query->execute();

        $this->assertEquals((object) ['Resultado' => 'success'], $result);
    }
}
