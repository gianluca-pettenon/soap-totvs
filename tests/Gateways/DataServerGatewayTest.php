<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Gateways;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\{OperationEnum, WsdlEnum};
use SoapTotvs\Gateways\DataServerGateway;

final class DataServerGatewayTest extends TestCase
{
    #[Test]
    public function saveRecordCallsAdapterCorrectly(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::SAVE_RECORD,
                [
                    'DataServerName' => 'DataServerTest',
                    'Contexto' => 1,
                    'XML' => '<xml>test</xml>'
                ]
            )
            ->willReturn((object) ['result' => 'saved']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->saveRecord(
            dataServer: 'DataServerTest',
            context: 1,
            xml: '<xml>test</xml>'
        );

        $this->assertEquals((object) ['result' => 'saved'], $result);
    }

    #[Test]
    public function readRecordCallsAdapterCorrectly(): void
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
                    'Contexto' => 1
                ]
            )
            ->willReturn((object) ['result' => 'read']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->readRecord(
            dataServer: 'DataServerTest',
            context: 1,
            primaryKey: 123
        );

        $this->assertEquals((object) ['result' => 'read'], $result);
    }

    #[Test]
    public function deleteRecordCallsAdapterCorrectly(): void
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
                    'Contexto' => 1
                ]
            )
            ->willReturn((object) ['result' => 'deleted']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->deleteRecord(
            dataServer: 'DataServerTest',
            context: 1,
            xml: '<xml>delete</xml>'
        );

        $this->assertEquals((object) ['result' => 'deleted'], $result);
    }

    #[Test]
    public function deleteRecordByKeyCallsAdapterCorrectly(): void
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
                    'Contexto' => 1
                ]
            )
            ->willReturn((object) ['result' => 'deleted_by_key']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->deleteRecordByKey(
            dataServer: 'DataServerTest',
            context: 1,
            primaryKey: 123
        );

        $this->assertEquals((object) ['result' => 'deleted_by_key'], $result);
    }

    #[Test]
    public function readViewCallsAdapterCorrectly(): void
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
                    'Contexto' => 'CODCOLIGADA=1;CODSISTEMA=S'
                ]
            )
            ->willReturn((object) ['result' => 'view']);

        $gateway = new DataServerGateway($adapter);
        $result = $gateway->readView(
            dataServer: 'DataServerTest',
            context: 'CODCOLIGADA=1;CODSISTEMA=S',
            filter: 'FILTER=1'
        );

        $this->assertEquals((object) ['result' => 'view'], $result);
    }
}
