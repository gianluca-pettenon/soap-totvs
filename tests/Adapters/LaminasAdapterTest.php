<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Adapters;

use Laminas\Soap\Client;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\{LaminasAdapter, SoapConfig};
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};

final class LaminasAdapterTest extends TestCase
{
    #[Test]
    public function callForwardsNamedParametersToLaminasClient(): void
    {
        $mockClient = $this->createMock(Client::class);

        $mockClient->expects($this->once())
            ->method('call')
            ->with(
                'RealizarConsultaSQL',
                ['codSentenca' => 'Example.001']
            )
            ->willReturn((object) ['result' => 'success']);

        $adapter = $this->getMockBuilder(LaminasAdapter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['createClient'])
            ->getMock();

        $adapter->expects($this->once())
            ->method('createClient')
            ->with(WsdlEnum::QUERY)
            ->willReturn($mockClient);

        $result = $adapter->call(
            WsdlEnum::QUERY,
            OperationEnum::REALIZE_SQL_QUERY,
            ['codSentenca' => 'Example.001']
        );

        $this->assertEquals((object) ['result' => 'success'], $result);
    }

    #[Test]
    public function createClientUsesSoapConfig(): void
    {
        $adapter = new LaminasAdapter(new SoapConfig('http://example.com', 'user', 'pass'));

        $method = new \ReflectionMethod(LaminasAdapter::class, 'createClient');
        $client = $method->invoke($adapter, WsdlEnum::QUERY);

        $this->assertInstanceOf(Client::class, $client);
    }
}
