<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Adapters;

use Laminas\Soap\Client;
use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\LaminasAdapter;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\WsdlEnum;

final class LaminasAdapterTest extends TestCase
{
    public function testCallDelegatesToLaminasClientCorrectly(): void
    {
        $mockClient = $this->createMock(Client::class);

        $mockClient->expects($this->once())
            ->method('call')
            ->with(
                'RealizarConsultaSQL',
                ['param1', 'param2']
            )
            ->willReturn((object) ['result' => 'success']);

        $adapter = $this->getMockBuilder(LaminasAdapter::class)
            ->onlyMethods(['createClient'])
            ->getMock();

        $adapter->expects($this->once())
            ->method('createClient')
            ->with(WsdlEnum::QUERY)
            ->willReturn($mockClient);

        $result = $adapter->call(
            WsdlEnum::QUERY,
            OperationEnum::REALIZE_SQL_QUERY,
            ['param1', 'param2']
        );

        $this->assertEquals((object) ['result' => 'success'], $result);
    }
}

