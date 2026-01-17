<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Gateways;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\ContextEnum;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Gateways\DataServerGateway;

final class DataServerGatewayTest extends TestCase
{
    public function testSaveRecordCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::SAVE_RECORD,
                [
                    'DataServerName' => 'DataServerTest',
                    'Contexto' => ContextEnum::DEFAULT->value,
                    'XML' => '<xml>test</xml>'
                ]
            )
            ->willReturn((object) ['result' => 'saved']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->saveRecord(
            dataServer: 'DataServerTest',
            context: ContextEnum::DEFAULT,
            xml: '<xml>test</xml>'
        );

        $this->assertEquals((object) ['result' => 'saved'], $result);
    }

    public function testReadRecordCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::READ_RECORD,
                [
                    'DataServerName' => 'DataServerTest',
                    'PrimaryKey' => 123,
                    'Contexto' => ContextEnum::DEFAULT->value
                ]
            )
            ->willReturn((object) ['result' => 'read']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->readRecord(
            dataServer: 'DataServerTest',
            context: ContextEnum::DEFAULT,
            primaryKey: 123
        );

        $this->assertEquals((object) ['result' => 'read'], $result);
    }

    public function testDeleteRecordCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::DELETE_RECORD,
                [
                    'DataServerName' => 'DataServerTest',
                    'XML' => '<xml>delete</xml>',
                    'Contexto' => ContextEnum::DEFAULT->value
                ]
            )
            ->willReturn((object) ['result' => 'deleted']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->deleteRecord(
            dataServer: 'DataServerTest',
            context: ContextEnum::DEFAULT,
            xml: '<xml>delete</xml>'
        );

        $this->assertEquals((object) ['result' => 'deleted'], $result);
    }

    public function testDeleteRecordByKeyCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::DELETE_RECORD_BY_KEY,
                [
                    'DataServerName' => 'DataServerTest',
                    'PrimaryKey' => 123,
                    'Contexto' => ContextEnum::DEFAULT->value
                ]
            )
            ->willReturn((object) ['result' => 'deleted_by_key']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->deleteRecordByKey(
            dataServer: 'DataServerTest',
            context: ContextEnum::DEFAULT,
            primaryKey: 123
        );

        $this->assertEquals((object) ['result' => 'deleted_by_key'], $result);
    }

    public function testReadViewCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::READ_VIEW,
                [
                    'DataServerName' => 'DataServerTest',
                    'Filtro' => 'FILTER=1',
                    'Contexto' => ContextEnum::DEFAULT->value
                ]
            )
            ->willReturn((object) ['result' => 'view']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->readView(
            dataServer: 'DataServerTest',
            context: ContextEnum::DEFAULT,
            filter: 'FILTER=1'
        );

        $this->assertEquals((object) ['result' => 'view'], $result);
    }
}
