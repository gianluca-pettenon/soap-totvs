<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\WebServices\DataServer;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\ContextEnum;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\WebServices\DataServer\DataServer;
use SoapTotvs\WebServices\DataServer\Object\DataServerObject;

final class DataServerTest extends TestCase
{
    public function testSaveRecordCallsAdapterWithCorrectParameters(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $dataServerObject = new DataServerObject(
            dataServer: 'DataServerName',
            context: ContextEnum::DEFAULT,
            xml: '<xml>data</xml>',
            primaryKey: null,
            filter: ''
        );

        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::SAVE_RECORD,
                [
                    'DataServerName' => 'DataServerName',
                    'Contexto' => ContextEnum::DEFAULT->value,
                    'XML' => '<xml>data</xml>'
                ]
            )
            ->willReturn((object) ['result' => 'saved']);

        $dataServer = new DataServer($adapter, $dataServerObject);
        $result = $dataServer->saveRecord();

        $this->assertEquals((object) ['result' => 'saved'], $result);
    }

    public function testReadRecordCallsAdapterWithCorrectParameters(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $dataServerObject = new DataServerObject(
            dataServer: 'DataServerName',
            context: ContextEnum::DEFAULT,
            xml: null,
            primaryKey: 123,
            filter: ''
        );

        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::READ_RECORD,
                [
                    'DataServerName' => 'DataServerName',
                    'PrimaryKey' => 123,
                    'Contexto' => ContextEnum::DEFAULT->value
                ]
            )
            ->willReturn((object) ['result' => 'read']);

        $dataServer = new DataServer($adapter, $dataServerObject);
        $result = $dataServer->readRecord();

        $this->assertEquals((object) ['result' => 'read'], $result);
    }

    public function testDeleteRecordCallsAdapterWithCorrectParameters(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $dataServerObject = new DataServerObject(
            dataServer: 'DataServerName',
            context: ContextEnum::DEFAULT,
            xml: '<xml>delete</xml>',
            primaryKey: null,
            filter: ''
        );

        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::DELETE_RECORD,
                [
                    'DataServerName' => 'DataServerName',
                    'XML' => '<xml>delete</xml>',
                    'Contexto' => ContextEnum::DEFAULT->value
                ]
            )
            ->willReturn((object) ['result' => 'deleted']);

        $dataServer = new DataServer($adapter, $dataServerObject);
        $result = $dataServer->deleteRecord();

        $this->assertEquals((object) ['result' => 'deleted'], $result);
    }

    public function testDeleteRecordByKeyCallsAdapterWithCorrectParameters(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $dataServerObject = new DataServerObject(
            dataServer: 'DataServerName',
            context: ContextEnum::DEFAULT,
            xml: null,
            primaryKey: 123,
            filter: ''
        );

        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::DELETE_RECORD_BY_KEY,
                [
                    'DataServerName' => 'DataServerName',
                    'PrimaryKey' => 123,
                    'Contexto' => ContextEnum::DEFAULT->value
                ]
            )
            ->willReturn((object) ['result' => 'deleted_by_key']);

        $dataServer = new DataServer($adapter, $dataServerObject);
        $result = $dataServer->deleteRecordByKey();

        $this->assertEquals((object) ['result' => 'deleted_by_key'], $result);
    }

    public function testReadViewCallsAdapterWithCorrectParameters(): void
    {
        $adapter = $this->createMock(AdapterInterface::class);
        $dataServerObject = new DataServerObject(
            dataServer: 'DataServerName',
            context: ContextEnum::DEFAULT,
            xml: null,
            primaryKey: null,
            filter: 'FILTER=VALUE'
        );

        $adapter->expects($this->once())
            ->method('call')
            ->with(
                WsdlEnum::DATASERVER,
                OperationEnum::READ_VIEW,
                [
                    'DataServerName' => 'DataServerName',
                    'Filtro' => 'FILTER=VALUE',
                    'Contexto' => ContextEnum::DEFAULT->value
                ]
            )
            ->willReturn((object) ['result' => 'view_data']);

        $dataServer = new DataServer($adapter, $dataServerObject);
        $result = $dataServer->readView();

        $this->assertEquals((object) ['result' => 'view_data'], $result);
    }
}
