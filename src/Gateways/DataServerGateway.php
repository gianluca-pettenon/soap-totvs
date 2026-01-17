<?php

namespace SoapTotvs\Gateways;

use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\Enums\ContextEnum;
use SoapTotvs\WebServices\DataServer\DataServer;
use SoapTotvs\WebServices\DataServer\Object\DataServerObject;

final class DataServerGateway
{
    public function __construct(
        private AdapterInterface $adapter
    ) {
    }

    public function saveRecord(
        string $dataServer,
        ContextEnum $context,
        string $xml
    ): object {
        $dataServerWebService = new DataServer(
            adapterInterface: $this->adapter,
            dataServerObject: new DataServerObject(
                dataServer: $dataServer,
                context: $context,
                xml: $xml,
                primaryKey: null,
                filter: ''
            )
        );

        return $dataServerWebService->saveRecord();
    }

    public function readRecord(
        string $dataServer,
        ContextEnum $context,
        int $primaryKey
    ): object {
        $dataServerWebService = new DataServer(
            adapterInterface: $this->adapter,
            dataServerObject: new DataServerObject(
                dataServer: $dataServer,
                context: $context,
                xml: null,
                primaryKey: $primaryKey,
                filter: ''
            )
        );

        return $dataServerWebService->readRecord();
    }

    public function deleteRecord(
        string $dataServer,
        ContextEnum $context,
        string $xml
    ): object {
        $dataServerWebService = new DataServer(
            adapterInterface: $this->adapter,
            dataServerObject: new DataServerObject(
                dataServer: $dataServer,
                context: $context,
                xml: $xml,
                primaryKey: null,
                filter: ''
            )
        );

        return $dataServerWebService->deleteRecord();
    }

    public function deleteRecordByKey(
        string $dataServer,
        ContextEnum $context,
        int $primaryKey
    ): object {
        $dataServerWebService = new DataServer(
            adapterInterface: $this->adapter,
            dataServerObject: new DataServerObject(
                dataServer: $dataServer,
                context: $context,
                xml: null,
                primaryKey: $primaryKey,
                filter: ''
            )
        );

        return $dataServerWebService->deleteRecordByKey();
    }

    public function readView(
        string $dataServer,
        ContextEnum $context,
        string $filter
    ): object {
        $dataServerWebService = new DataServer(
            adapterInterface: $this->adapter,
            dataServerObject: new DataServerObject(
                dataServer: $dataServer,
                context: $context,
                xml: null,
                primaryKey: null,
                filter: $filter
            )
        );

        return $dataServerWebService->readView();
    }
}

