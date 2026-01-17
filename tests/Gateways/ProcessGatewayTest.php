<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Gateways;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Gateways\ProcessGateway;

final class ProcessGatewayTest extends TestCase
{
    public function testExecuteCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::PROCESS,
                OperationEnum::EXECUTE_WITH_XML_PARAMS,
                [
                    'ProcessServerName' => 'ProcessTest',
                    'strXmlParams' => '<xml>params</xml>'
                ]
            )
            ->willReturn(12345);

        $gateway = new ProcessGateway($adapter);
        $result = $gateway->execute(
            process: 'ProcessTest',
            xml: '<xml>params</xml>'
        );

        $this->assertEquals(12345, $result);
    }
}
