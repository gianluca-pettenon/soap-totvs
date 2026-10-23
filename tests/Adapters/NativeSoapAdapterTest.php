<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Adapters;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\{NativeSoapAdapter, SoapConfig};
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};
use SoapClient;

final class NativeSoapAdapterTest extends TestCase
{
    #[Test]
    public function callForwardsNamedParametersToSoapClient(): void
    {
        $mockSoapClient = $this->createMock(SoapClient::class);

        $mockSoapClient->expects($this->once())
            ->method('__call')
            ->with(
                'RealizarConsultaSQL',
                ['codSentenca' => 'Example.001']
            )
            ->willReturn((object) ['result' => 'success']);

        $adapter = $this->getMockBuilder(NativeSoapAdapter::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['createClient'])
            ->getMock();

        $adapter->expects($this->once())
            ->method('createClient')
            ->with(WsdlEnum::QUERY)
            ->willReturn($mockSoapClient);

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
        $adapter = new NativeSoapAdapter(new SoapConfig('http://invalid-host', 'user', 'pass', ['trace' => 1]));

        $method = new \ReflectionMethod(NativeSoapAdapter::class, 'createClient');

        $this->expectException(\SoapFault::class);

        $method->invoke($adapter, WsdlEnum::QUERY);
    }
}
