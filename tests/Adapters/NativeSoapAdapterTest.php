<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Adapters;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\NativeSoapAdapter;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\WsdlEnum;
use SoapClient;

final class NativeSoapAdapterTest extends TestCase
{
    public function testCallDelegatesToSoapClientCorrectly(): void
    {
        $mockSoapClient = $this->createMock(SoapClient::class);

        $mockSoapClient->expects($this->once())
            ->method('__call')
            ->with(
                'RealizarConsultaSQL',
                ['param1', 'param2']
            )
            ->willReturn((object) ['result' => 'success']);

        $adapter = $this->getMockBuilder(NativeSoapAdapter::class)
            ->onlyMethods(['createClient'])
            ->getMock();

        $adapter->expects($this->any())
            ->method('createClient')
            ->willReturn($mockSoapClient);

        $result = $adapter->call(
            WsdlEnum::QUERY,
            OperationEnum::REALIZE_SQL_QUERY,
            ['param1', 'param2']
        );

        $this->assertEquals((object) ['result' => 'success'], $result);
    }

    public function testCreateClientIsExecutedUsingEnvironmentConfiguration(): void
    {
        putenv('WSHOST=http://invalid-host');
        putenv('WSUSER=user');
        putenv('WSPASS=pass');

        $adapter = new NativeSoapAdapter(['trace' => 1]);

        $reflection = new \ReflectionClass(NativeSoapAdapter::class);
        $method = $reflection->getMethod('createClient');
        $method->setAccessible(true);

        $this->expectException(\SoapFault::class);

        $method->invoke($adapter, WsdlEnum::QUERY);
    }

    public function testCallSupportsNamedArguments(): void
    {
        $mockSoapClient = $this->createMock(SoapClient::class);

        $mockSoapClient->expects($this->once())
            ->method('__call')
            ->with(
                'RealizarConsultaSQL',
                ['p1' => 'value1', 'p2' => 'value2']
            )
            ->willReturn((object) ['result' => 'success']);

        $adapter = $this->getMockBuilder(NativeSoapAdapter::class)
            ->onlyMethods(['createClient'])
            ->getMock();

        $adapter->expects($this->any())
            ->method('createClient')
            ->willReturn($mockSoapClient);

        $result = $adapter->call(
            WsdlEnum::QUERY,
            OperationEnum::REALIZE_SQL_QUERY,
            ['p1' => 'value1', 'p2' => 'value2']
        );

        $this->assertEquals((object) ['result' => 'success'], $result);
    }
}
