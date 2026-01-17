<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\WebServices\Process;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\WebServices\Process\Object\ProcessObject;
use SoapTotvs\WebServices\Process\Process;

final class ProcessTest extends TestCase
{
    public function testExecuteCallsAdapterWithCorrectParameters(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $processObject = new ProcessObject(
            process: 'ProcessName',
            xml: '<xml>params</xml>'
        );

        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::PROCESS,
                OperationEnum::EXECUTE_WITH_XML_PARAMS,
                [
                    'ProcessServerName' => 'ProcessName',
                    'strXmlParams' => '<xml>params</xml>'
                ]
            )
            ->willReturn(12345);

        $process = new Process($adapter, $processObject);
        $result = $process->execute();

        $this->assertEquals(12345, $result);
    }
}
